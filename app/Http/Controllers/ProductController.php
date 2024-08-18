<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Support\Str;




class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all()->load('categories'); 
        $categories = Category::all();
        
        
        return Inertia::render('Products/Index', ['products' => $products, 'categories' => $categories]);
    }


    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required | image | mimes:jpeg,png,jpg,gif,svg',
            'stock' => 'required',
            'categorias' => 'required',
            'precio' => 'required | integer',
        ]);


        $imagen = $request->file('imagen');
        $nombreImagen = Str::uuid() . "." . $imagen->extension();
        $url_imagen = '/uploads/images/' . $nombreImagen;
        $categorias = $request->categorias;

        try {
            $imagen->move(public_path('uploads/images'), $nombreImagen);

            $newProduct = Product::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'imagen' => $url_imagen,
                'stock' => $request->stock,
                'precio' => $request->precio,

            ]);

            foreach ($categorias as $key => $value) {
                $newProduct->categories()->attach($value);
            }

            return redirect()->route('product.index');

        } catch (Exception $e) {
            return $e;
        }
        

        return redirect()->route('product.index');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->categories()->detach();
        $product->delete();
        $ruta = public_path($product->imagen);
        if (file_exists($ruta)) {
            unlink($ruta);
        }
        
        return redirect()->route('product.index');
    }

    public function update(Request $request, $id)
    {

        $product = Product::find($id);
        $imagen_anterior = $product->imagen;


        if($request->hasFile('nueva_imagen')){
            $imagen = $request->file('nueva_imagen');
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            $url_imagen = '/uploads/images/' . $nombreImagen;
            $imagen->move(public_path('uploads/images'), $nombreImagen);
            $product->imagen = $url_imagen;

            $ruta = public_path($imagen_anterior);
            if (file_exists($ruta)) {
                unlink($ruta);
            }

        }

            $product->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'stock' => $request->stock,
                'precio' => $request->precio,
            ]);

            
            $product->categories()->sync($request->categoriasSelectas);

            

            $product->save();

            return redirect()->route('product.show', $id);            
        

    
    }

    public function show($id)
    {
        $product = Product::find($id);
        $product->load('categories');
        $categorias = Category::all();
        return Inertia::render('Products/Show', ['product' => $product, 'categorias' => $categorias]);
    }


    public function select ($id)
    {
        $product = Product::find($id);
        $product->load('categories');
        $categorias = Category::all();
        return Inertia::render('Products/Select', ['product' => $product, 'categorias' => $categorias]);
    }




}

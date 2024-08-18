<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;


use function Termwind\render;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return Inertia::render('Category/Index', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255', 'unique:App\Models\Category,nombre', 'min:3'],
        ]);
        Category::create($request->all());
        return redirect()->route('category.index')->with('success', 'La Categoría se agrego correctamente');
    }

    public function update(Request $request, $id)
    {
   
        $category = Category::find($id);
        
        $validateData = $request->validate([
            'nombre' => ['required', 'string', 'max:255', 'unique:App\Models\Category,nombre', 'min:3'],
        ]);

        $category->nombre = $validateData['nombre'];
        $category->save();
        
        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        
            $category = Category::find($id);
            $products = $category->products;
            foreach ($products as $product) {
                $product->categories()->detach($category);
            }

            $category->delete();
            return redirect()->route('category.index');


    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Sale;

class CartController extends Controller
{

    public function index()
    {
        return Inertia::render('Cart/Index');   
    }

    public function store(Request $request)
    {

        $datos = $request->json()->all();

        $productos = $datos['items'];

        $sale = new Sale();

        $sale->nombre = $datos['nombre'];
        $sale->apellido = $datos['apellido'];
        $sale->dni = $datos['dni'];
        $sale->email = $datos['email'];
        $sale->telefono = $datos['telefono'];
        $sale->direccion = $datos['direccion'];
        $sale->metodoDeEnvio = $datos['metodoDeEnvio'];
        $sale->total = $datos['total'];

        $productosConDatos = [];

        $sale->save();


        foreach ($datos['items'] as $producto){
            $productosConDatos[$producto['id']] = [
                'quantity' => $producto['cantidad'],
                'price' => $producto['precio'],
            ];
        }

        $sale->products()->sync($productosConDatos);


    
        
    }
}

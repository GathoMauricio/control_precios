<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function store(Request $request)
    {
        $producto = Producto::create([
            'user_id' => \Auth::user()->id,
            'nombre' => strtoupper($request->nombre),
            'descripcion' => $request->descripcion,
            'unidad_id' => $request->unidad_id,
        ]);
        if ($producto) {
            return redirect()->back()->with('mensaje', "Producto agregado");
        }
    }
}

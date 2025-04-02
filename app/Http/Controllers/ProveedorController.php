<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    public function store(Request $request)
    {
        $producto = Proveedor::create([
            'user_id' => \Auth::user()->id,
            'nombre' => strtoupper($request->nombre),
            'descripcion' => $request->descripcion,
        ]);
        if ($producto) {
            return redirect()->back()->with('mensaje', "Proveedor agregado");
        }
    }
}

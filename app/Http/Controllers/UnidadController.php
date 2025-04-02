<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidad;

class UnidadController extends Controller
{
    public function store(Request $request)
    {
        $producto = Unidad::create([
            'user_id' => \Auth::user()->id,
            'nombre' => strtoupper($request->nombre),
        ]);
        if ($producto) {
            return redirect()->back()->with('mensaje', "Unidad agregada");
        }
    }
}

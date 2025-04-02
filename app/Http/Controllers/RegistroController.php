<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;
use App\Models\Producto;
use App\Models\Proveedor;

class RegistroController extends Controller
{
    public function index()
    {
        $registros = Registro::orderBy('created_at', 'DESC')->get();
        $productos = Producto::orderBy('nombre', 'ASC')->get();
        return view('registro.index', compact('registros', 'productos'));
    }

    public function show($id)
    {
        $registro = Registro::findOrFail($id);
        return view('registro.show', compact('registro'));
    }

    public function store(Request $request)
    {
        $registro = Registro::create([
            'user_id' => \Auth::user()->id,
            'producto_id' => $request->producto_id,
        ]);

        if ($registro) {
            return redirect()->route('/registros/edit', $registro->id);
        }
        return dd($request);
    }

    public function edit($id)
    {
        $registro = Registro::findOrFail($id);
        $proveedores = Proveedor::orderBy('nombre', 'ASC')->get();
        return view('registro.edit', compact('registro', 'proveedores'));
    }
}

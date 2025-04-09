<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Unidad;

class RegistroController extends Controller
{
    public function index()
    {
        $registros = Registro::orderBy('created_at', 'DESC')->paginate(15);
        $productos = Producto::orderBy('nombre', 'ASC')->paginate(15);
        $unidades = Unidad::orderBy('nombre', 'ASC')->get();
        return view('registro.index', compact('registros', 'productos', 'unidades'));
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

    public function destroy($id)
    {
        $registro = Registro::findOrFail($id);
        if ($registro->delete()) {
            return redirect()->back()->with('mensaje', 'Registro eliminado');
        }
    }

    public function cerrar($id)
    {
        $registro = Registro::findOrFail($id);
        $registro->estatus = 'CERRADO';
        if ($registro->save()) {
            return redirect()->route('registros')->with('mensaje', 'Registro actualizado');
        }
    }
}

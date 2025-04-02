<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cotizacion;

class CotizacionController extends Controller
{
    public function store(Request $request)
    {
        $cotizacion = Cotizacion::create([
            'user_id' => \Auth::user()->id,
            'registro_id' => $request->registro_id,
            'proveedor_id' => $request->proveedor_id,
            'precio' => $request->precio,
            'observaciones' => $request->observaciones,
        ]);
        if ($cotizacion) {
            return redirect()->back()->with('mensaje', "Cotización agregada");
        }
    }

    public function destroy($id)
    {
        $cotizacion = Cotizacion::findOrFail($id);
        if ($cotizacion->delete()) {
            return redirect()->back()->with('mensaje', 'Cotizacion eliminado');
        }
    }
}

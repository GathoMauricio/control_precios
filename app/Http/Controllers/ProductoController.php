<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        // $query = Producto::with(['usuario', 'unidadd'])->paginate(15);

        // if ($request->has('search')) {
        //     $search = $request->input('search');
        //     $query->where('nombre', 'LIKE', "%{$search}%")
        //         ->orWhere('descripcion', 'LIKE', "%{$search}%");
        // }

        $productos = Producto::orderBy('nombre')->paginate(15);
        return view('producto.index', compact('productos'));
    }

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

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 p-3">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        <a href="javascript:void(0);" onclick="agregarProducto();" style="float:right">Agregar producto</a>
                        <br>
                        <a href="javascript:void(0);" onclick="agregarUnidad();" style="float:right">Agregar unidad</a>
                        Crear registro
                    </div>
                    <div class="card-body">
                        <form action="{{ route('/registros/store') }}" method="POST">
                            @csrf
                            <table style="width:100%;">
                                <tr>
                                    <td width="90%">
                                        <select name="producto_id" class="form-control select2" required>
                                            <option value>
                                                -- Seleccione un producto de la lista o agregue uno nuevo solo si este no
                                                existe aún --
                                            </option>
                                            @foreach ($productos as $producto)
                                                <option value="{{ $producto->id }}">
                                                    {{ $producto->nombre }} {{ $producto->unidadd->nombre }} -
                                                    {{ $producto->descripcion }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td width="10%" class="p-1">
                                        <input type="submit" class="btn btn-primary" value="Guardar">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12 p-3">
                {{ $registros->links('pagination::bootstrap-4') }}
                <div class="card">
                    <div class="card-header font-weight-bold">
                        {{--  <a href="{{ route('registros/create') }}" class="float-right">Crear registro</a>  --}}
                        Registros
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Estatus</th>
                                    <th>Producto</th>
                                    <th>Unidad</th>
                                    <th>Usuario</th>
                                    <th>Cotizaciones</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($registros as $registro)
                                    <tr>
                                        <td>{{ explode(' ', $registro->created_at)[0] }}</td>
                                        <td>{{ $registro->estatus }}</td>
                                        <td>{{ $registro->producto->nombre }}</td>
                                        <td>{{ $registro->producto->unidadd->nombre }}</td>
                                        <td>{{ $registro->usuario->name }}</td>
                                        <td>{{ $registro->cotizaciones->count() }}</td>
                                        <td>
                                            <a href="{{ route('/registros/show', $registro->id) }}">Abrir registro</a>
                                            @if (($registro->estatus == 'PENDIENTE' && Auth::user()->id == $registro->user_id) || Auth::user()->rol_id == 1)
                                                <br>
                                                <a href="{{ route('/registros/edit', $registro->id) }}">Editar registro</a>
                                            @endif
                                            @if (Auth::user()->rol_id == 1)
                                                <br>
                                                <a href="javascript:void(0)"
                                                    onclick="eliminarRegistro({{ $registro->id }})"
                                                    class="text-danger">Elminar registro</a>
                                                <form action="{{ route('/registros/destroy', $registro->id) }}"
                                                    id="form_registros_delete_{{ $registro->id }}" style="display:none"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="7" class="text-center">Sin registros</th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('producto.create')
    @include('unidad.create')
@endsection

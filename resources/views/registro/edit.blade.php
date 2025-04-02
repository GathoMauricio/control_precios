@extends('layouts.app')

@section('content')
    @if ($registro->cotizaciones->count() < 3)
        <div class="alert alert-warning" role="alert">
            Debes agregar por lo menos 3 cotizaciones para cerrar este proceso
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 p-3">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        <a href="javascript:void(0);" onclick="agregarProveedor();" style="float:right">Agregar proveedor</a>
                        Agregar cotizacion
                    </div>
                    <div class="card-body">
                        <form action="{{ route('/cotizacion/store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="registro_id" value="{{ $registro->id }}">
                            <table style="width:100%;">
                                <tr>
                                    <td>
                                        <select name="proveedor_id" class="form-control select2" required>
                                            <option value>
                                                -- Seleccione un proveedor de la lista o agregue uno nuevo solo si este no
                                                existe aún --
                                            </option>
                                            @foreach ($proveedores as $proveedor)
                                                <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }} -
                                                    {{ $proveedor->descripcion }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input name="precio" placeholder="Precio" class="form-control precio" required>
                                    </td>
                                    <td>
                                        <input name="observaciones" placeholder="Observaciones (Opcional)"
                                            class="form-control">
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

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        {{ $registro->producto->nombre }}
                        <br>
                        <i>{{ $registro->producto->descripcion }} - {{ explode(' ', $registro->created_at)[0] }}</i>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Fecha cotización</th>
                                    <th>Proveedor</th>
                                    <th>Precio</th>
                                    <th>Observaciones</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tobdy>
                                @forelse ($registro->cotizaciones as $cotizacion)
                                    <tr>
                                        <td>{{ explode(' ', $cotizacion->created_at)[0] }}</td>
                                        <td>{{ $cotizacion->proveedor->nombre }}</td>
                                        <td>${{ $cotizacion->precio }}</td>
                                        <td>{{ $cotizacion->observaciones }}</td>
                                        <td>
                                            @if (Auth::user()->id == $cotizacion->user_id || Auth::user()->rol_id == 1)
                                                <br>
                                                <a href="javascript:void(0)"
                                                    onclick="eliminarCotizacion({{ $cotizacion->id }})"
                                                    class="text-danger">Elminar cotizacion</a>
                                                <form action="{{ route('/cotizacion/destroy', $cotizacion->id) }}"
                                                    id="form_contizacion_delete_{{ $cotizacion->id }}" style="display:none"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Sin cotizaciones</td>
                                    </tr>
                                @endforelse
                            </tobdy>
                        </table>
                    </div>
                </div>
                <br>
                @if ($registro->cotizaciones->count() >= 3)
                    <a href="javascript:void(0)" onclick="cerrarRegistro({{ $registro->id }})" class="btn btn-primary"
                        style="float:right;">Cerrar registro</a>
                    <form action="{{ route('/registros/cerrar', $registro->id) }}"
                        id="form_registros_cerrar_{{ $registro->id }}" style="display:none" method="POST">
                        @csrf
                        @method('PUT')
                    </form>
                @endif
            </div>
        </div>
    </div>
    @include('proveedor.create')
@endsection

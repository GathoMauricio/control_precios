@extends('layouts.app')

@section('content')
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
                                        <input name="precio" placeholder="Precio" class="form-control" required>
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
                        <i>{{ $registro->producto->descripcion }}</i>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Proveedor</th>
                                    <th>Precio</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tobdy>
                                @forelse ($registro->cotizaciones as $coizacion)
                                    <tr>
                                        <td>{{ explode(' ', $coizacion->created_at)[0] }}</td>
                                        <td>{{ $coizacion->proveedor->nombre }}</td>
                                        <td>${{ $coizacion->precio }}</td>
                                        <td></td>
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
            </div>
        </div>
    </div>
    @include('proveedor.create')
@endsection

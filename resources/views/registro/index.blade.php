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
                        <h5>Iniciar proceso de cotización</h5>
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

            {{ $productos->links('pagination::bootstrap-4') }}
            @foreach ($productos as $producto)
                @if ($producto->registros->count())
                    <div class="card container_by_product">
                        <div class="card-header">
                            <h6 class="text-center">
                                {{ $producto->nombre }} - {{ $producto->unidad }}
                                <br>
                                {{ $producto->descripcion }}
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($producto->registros as $registro)
                                    @if ($registro->cotizaciones->count() > 0)
                                        <div class="col-md-12 p-2">
                                            <small>
                                                {{ $registro->created_at }}
                                                <span style="float:right"><i>{{ $registro->usuario->name }}</i></span>
                                            </small>
                                            <div>
                                                @php
                                                    $precios = $registro->cotizaciones->pluck('precio')->toArray();
                                                @endphp
                                                <table border="1" style="width:100%">
                                                    <tr>

                                                        @foreach ($registro->cotizaciones as $cotizacion)
                                                            @if ($cotizacion->precio == min($precios))
                                                                <td class="text-center bg-info">
                                                                @else
                                                                <td class="text-center">
                                                            @endif
                                                            <b>{{ $cotizacion->proveedor->nombre }}</b>
                                                            </td>
                                                        @endforeach
                                                        <td class="text-center bg-info">
                                                            <b>Ganador</b>
                                                        </td>
                                                    </tr>
                                                    <tr>

                                                        @foreach ($registro->cotizaciones as $cotizacion)
                                                            <td class="text-center">${{ $cotizacion->precio }}</td>
                                                        @endforeach
                                                        <td class="text-center">
                                                            ${{ min($precios) }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            {{ $productos->links('pagination::bootstrap-4') }}
        </div>
    </div>
    @include('producto.create')
    @include('unidad.create')
@endsection
@section('custom-scripts')
    <style>
        .container_by_product {
            height: 300px;
            overflow: hidden;
            overflow-y: scroll;
        }
    </style>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-3">Productos</h2>

        {{ $productos->links('pagination::bootstrap-4') }}
        @foreach ($productos as $producto)
            @if ($producto->registros->count())
                <div class="card container_by_product">
                    <div class="card-header">
                        <h6 class="text-center">{{ $producto->nombre }}</h6>
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

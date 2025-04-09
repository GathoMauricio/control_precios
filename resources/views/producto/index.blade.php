@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-3">Produtos</h2>

        @foreach ($productos as $producto)
            @if ($producto->registros->count())
                <div class="card">
                    <div class="card-header">
                        <h6>{{ $producto->nombre }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($producto->registros as $registro)
                                @if ($registro->cotizaciones->count() > 0)
                                    <div class="col-md-4">
                                        <small>{{ $registro->created_at }}</small>
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                @foreach ($registro->cotizaciones as $cotizacion)
                                                    <td>{{ $cotizacion->proveedor->nombre }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                @foreach ($registro->cotizaciones as $cotizacion)
                                                    <td>${{ $cotizacion->precio }}</td>
                                                @endforeach
                                            </tr>
                                        </table>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

    </div>
@endsection

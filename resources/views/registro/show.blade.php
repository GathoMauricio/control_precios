@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
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
                                    <th>Costo</th>
                                </tr>
                            </thead>
                            <tobdy>
                                @forelse ($registro->cotizaciones as $coizacion)
                                    <tr>
                                        <td>{{ explode(' ', $coizacion->created_at)[0] }}</td>
                                        <td>{{ $coizacion->proveedor->nombre }}</td>
                                        <td>${{ $coizacion->precio }}</td>
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
@endsection

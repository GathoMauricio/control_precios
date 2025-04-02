@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
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
                                    <th>Costo</th>
                                </tr>
                            </thead>
                            <tobdy>
                                @forelse ($registro->cotizaciones as $coizacion)
                                    <tr>
                                        <td>Fecha</td>
                                        <td>Proveedor</td>
                                        <td>Costo</td>
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

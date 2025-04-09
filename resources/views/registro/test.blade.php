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
                                    <a href="javascript:void(0)" onclick="eliminarRegistro({{ $registro->id }})"
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

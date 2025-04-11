@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-3">Usuarios</h2>
        <a href="{{ route('users.create') }}" style="float: right;">Crear usuario</a>
        <br><br>
        <!-- Formulario de búsqueda -->
        <form action="{{ route('users.index') }}" method="GET" class="mb-3 d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Buscar por nombre o email..."
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">🔍 Buscar</button>
            @if (request('search'))
                <a href="{{ route('users.index') }}" class="btn btn-secondary ms-2">✖️ Limpiar</a>
            @endif
        </form>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge {{ $user->rol_id == 1 ? 'bg-danger' : 'bg-primary' }}">
                                {{ $user->rol_id == 1 ? 'Administrador' : 'Empleado' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">✏️ Editar</a>

                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">🗑️
                                    Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No se encontraron usuarios.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

        <!-- Paginación -->
        <div class="d-flex justify-content-center">
            {{ $users->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection

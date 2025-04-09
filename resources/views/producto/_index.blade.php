@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-3">Lista de Productos</h2>

        <!-- Botón para agregar un nuevo producto -->
        <a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">➕ Nuevo Producto</a>

        <!-- Buscador -->
        <form action="{{ route('productos.index') }}" method="GET" class="mb-3 d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Buscar producto..."
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">🔍 Buscar</button>
            @if (request('search'))
                <a href="{{ route('productos.index') }}" class="btn btn-secondary ms-2">✖️ Limpiar</a>
            @endif
        </form>

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Tabla de productos -->
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Unidad</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($productos as $producto)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>{{ $producto->unidadd->nombre ?? 'Sin unidad' }}</td>
                        <td>{{ $producto->usuario->name ?? 'Sin usuario' }}</td>
                        <td>
                            <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning btn-sm">✏️ Editar</a>

                            <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro?')">🗑️ Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay productos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="d-flex justify-content-center">
            {{ $productos->appends(['search' => request('search')])->links() }}
        </div>
    </div>
@endsection

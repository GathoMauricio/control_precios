@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Editar Usuario</h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Rol</label>
                        <select name="rol_id" class="form-select" required>
                            <option value="1" {{ $user->rol_id == 1 ? 'selected' : '' }}>Administrador</option>
                            <option value="2" {{ $user->rol_id == 2 ? 'selected' : '' }}>Empleado</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary">💾 Actualizar</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">↩️ Volver</a>
                </form>
            </div>
        </div>
    </div>
@endsection

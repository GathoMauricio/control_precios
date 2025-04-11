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

        <div class="card shadow-sm">
            <div class="card-header">
                Password
            </div>
            <form action="{{ route('users.update_password', $user) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                        @error('password')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmar</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">💾 Actualizar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Crear Usuario</h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Rol</label>
                        <select name="rol_id" class="form-select" required>
                            <option value="1">Administrador</option>
                            <option value="2">Empleado</option>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success">💾 Guardar Usuario</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">↩️ Volver</a>
                </form>
            </div>
        </div>
    </div>
@endsection

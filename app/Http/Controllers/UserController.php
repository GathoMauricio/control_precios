<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Listar usuarios
    public function index(Request $request)
    {
        $query = User::query();

        // Si hay un término de búsqueda, filtrar por nombre o email
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
        }

        $users = $query->paginate(10); // Paginación de 10 usuarios por página
        return view('users.index', compact('users'));
    }


    // Mostrar formulario de creación
    public function create()
    {
        return view('users.create');
    }

    // Guardar un nuevo usuario
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'rol_id' => 'required|in:1,2', // Validamos que sea 1 o 2
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'rol_id' => $validated['rol_id'],
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Actualizar usuario
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'rol_id' => 'required|in:1,2',
        ]);

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado.');
    }

    // Eliminar usuario
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado.');
    }

    public function updatePassword(Request $request, $id)
    {
        // Validar los datos de entrada
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);
        $user = User::find($id);
        $user->password = bcrypt($request->password);
        $user->save();
        return back()->with('mensaje', 'Contraseña actualizada correctamente.');
    }
}

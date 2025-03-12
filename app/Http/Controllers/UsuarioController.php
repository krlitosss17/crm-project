<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role; // Importa el modelo Role
use Illuminate\Http\Request;
use Inertia\Inertia;

class UsuarioController extends Controller
{
    // Mostrar la vista de todos los usuarios
    public function index()
{
    // Obtener todos los usuarios con sus roles
    // Usamos 'with' para incluir los roles de cada usuario en la consulta
    $users = User::with('roles')->get();

    // Devolvemos la vista Inertia, pasando los usuarios como propiedad
    return Inertia::render('Usuarios/Index', [
        'users' => $users,
    ]);
}

    // Mostrar el formulario para editar un usuario
    public function edit($id)
{
    // Obtener el usuario por su ID
    $user = User::findOrFail($id);

    // Pasar los datos del usuario a la vista de edición
    return view('usuarios.edit', compact('user'));
}

    // Actualizar el usuario
    public function update(Request $request, $id)
{
    // Validación de datos
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'role' => 'required|in:admin,ejecutivo,coordinador',
    ]);

    // Buscar el usuario y actualizarlo
    $user = User::findOrFail($id);
    $user->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
    ]);

    // Asignar el rol
    $user->syncRoles($validated['role']);

    // Redirigir con éxito
    return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado');
}





}

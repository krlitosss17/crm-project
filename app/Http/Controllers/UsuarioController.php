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
        $usuario = User::with('roles')->findOrFail($id);
        $roles = Role::all(); // Trae todos los roles disponibles
        return Inertia::render('Usuarios/Edit', [
            'usuario' => $usuario,
            'roles' => $roles
        ]);
    }

    // Actualizar el usuario
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->update($request->only('name', 'email')); // Actualiza el nombre y el correo

        // Actualizar los roles
        $usuario->roles()->sync($request->roles); // Sincroniza los roles seleccionados

        return redirect()->route('usuarios.index');
    }
}

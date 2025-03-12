<!-- resources/views/usuarios/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Usuarios</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>
                            <!-- Aquí puedes agregar enlaces a otras acciones como editar, eliminar, etc. -->
                            <a href="{{ route('usuarios.index', $usuario->id) }}" class="btn btn-info">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

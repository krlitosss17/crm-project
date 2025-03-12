<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Asignar permisos a Admin
        $admin = Role::findByName('Admin');
        $admin->givePermissionTo(Permission::all());

        // Asignar permisos a Ejecutivo
        $ejecutivo = Role::findByName('Ejecutivo');
        $ejecutivo->givePermissionTo('view user'); // Solo puede ver usuarios

        // Asignar permisos a Coordinador
        $coordinador = Role::findByName('Coordinador');
        $coordinador->givePermissionTo('view user', 'edit user'); // Puede ver y editar usuarios
    }
}

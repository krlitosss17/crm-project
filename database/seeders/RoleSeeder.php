<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Crear los roles principales
        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Coordinador']);
        Role::create(['name' => 'Ejecutivo']);
    }
}

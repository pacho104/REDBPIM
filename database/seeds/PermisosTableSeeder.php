<?php

use Bican\Roles\Models\Permission;
use Illuminate\Database\Seeder;

class PermisosTableSeeder extends Seeder
{
    Public Function run()
    {
        Permission::create(
            [
                'name' => 'create_dep',
                'slug' => 'create.dep',
                'description' => 'Crear Departamento',
            ]
        );

        Permission::create(
            [
                'name' => 'edit_dep',
                'slug' => 'edit.dep',
                'description' => 'Editar Departamento',
            ]
        );

        Permission::create(
            [
                'name' => 'delete_dep',
                'slug' => 'delete.dep',
                'description' => 'Eliminar Departamento',
            ]
        );
    }
}
<?php

use Bican\Roles\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    Public Function run()
    {

        $adminDepartamentalRole = Role::create(
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Administración - Planeación Departamental',
                'level' => '1',
            ]
        );

        $adminMunicipalRole = Role::create(
            [
                'name' => 'AdminMunicipal',
                'slug' => 'admin_municipal',
                'description' => 'Administración - Planeación Municipal',
                'level' => '2',
            ]
        );

        $secDepartmental = Role::create(
            [
                'name' => 'secDepartamenta',
                'slug' => 'sec_departamental',
                'description' => 'Secretaría de Planeación Departamental',
                'level' => '3',
            ]
        );

        $secMunicipal = Role::create(
            [
                'name' => 'secMunicipal',
                'slug' => 'sec_municipal',
                'description' => 'Secretaría de Planeación Municipal',
                'level' => '4',
            ]
        );

        $secSectorial = Role::create(
            [
                'name' => 'secSectorial',
                'slug' => 'sec_sectorial',
                'description' => 'Secretaría Sectorial',
                'level' => '5',
            ]
        );

    }
}





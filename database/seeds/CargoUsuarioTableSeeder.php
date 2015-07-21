<?php

use App\CargoUsuario;
use Illuminate\Database\Seeder;

class CargoUsuarioTableSeeder extends Seeder
{

    Public Function run()
    {

        CargoUsuario::create(
            [
                'nom_cargo' => 'Secretario de Gobierno'
            ]
        );

        CargoUsuario::create(
            [
                'nom_cargo' => 'Jefe de Banco de Proyectos Municipal',
            ]
        );
        CargoUsuario::create(
            [
                'nom_cargo' => 'Tesorero',
            ]
        );

    }

}
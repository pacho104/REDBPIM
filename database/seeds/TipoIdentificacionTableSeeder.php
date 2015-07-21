<?php

use App\TipoIdentificacion;
use Illuminate\Database\Seeder;

class TipoIdentificacionTableSeeder extends Seeder
{

    Public Function run()
    {

        TipoIdentificacion::create(
            [
                'nom_identificacion' => 'Cédula de Ciudadania',
            ]
        );

        TipoIdentificacion::create(
            [
                'nom_identificacion' => 'Pasaporte',
            ]
        );
        TipoIdentificacion::create(
            [
                'nom_identificacion' => 'Residencia de Extranjería',
            ]
        );

    }

}
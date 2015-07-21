<?php

use App\Secretaria;
use Illuminate\Database\Seeder;

class TipoSecretariaTableSeeder extends Seeder
{

    Public Function run()
    {

        Secretaria::create(
            [
                'nombre_secretaria' => 'Secretaria de Planeación Municipal',
            ]
        );

        Secretaria::create(
            [
                'nombre_secretaria' => 'Secretaria de Agricultura',
            ]
        );
        Secretaria::create(
            [
                'nombre_secretaria' => 'Secretaria de Salud',
            ]
        );

    }

}
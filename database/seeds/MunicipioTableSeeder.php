<?php

use App\Municipio;
use Illuminate\Database\Seeder;

class MunicipioTableSeeder extends Seeder
{

    Public Function run()
    {

        Municipio::create(
            [
                'nom_municipio' => 'Pasto',
                'cod_dane_mun' => '52001',
                'id_departamento' => '1',
            ]
        );

        Municipio::create(
            [
                'nom_municipio' => 'Ipiales',
                'cod_dane_mun' => '52010',
                'id_departamento' => '1',
            ]
        );
        Municipio::create(
            [
                'nom_municipio' => 'Túquerres',
                'cod_dane_mun' => '52011',
                'id_departamento' => '1',
            ]
        );

    }

}
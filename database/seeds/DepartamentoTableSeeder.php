<?php

use App\Departamento;
use Illuminate\Database\Seeder;

class DepartamentoTableSeeder extends Seeder
{

    Public Function run()
    {


        Departamento::create(
            [
                'nom_departamento' => 'Nariño',
                'cod_dane_dep' => '52',
            ]
        );

    }

}
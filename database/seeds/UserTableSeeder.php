<?php

use App\User;
use App\Variables;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{


    Public Function run()
    {

        $estado = new Variables();

        User::create(
            [
                'nom_usuario' => 'Juan Sebastian',
                'ape_usuario' => 'Maya Narvaez',
                'num_identificacion' => '1085293173',
                'tel_usuario' => '7363301',
                'cel_usuario' => '3147708366',
                'user_login' => 'jumaya23',
                'email' => 'jumaya19@gmail.com',
                'password' => \Hash::make('123456'),
                'estado_user' => $estado->UserRegistrado(),
                'id_municipio' => '1',
                'id_tipo_secretaria' => '1',
                'id_tipo_identificacion' => '1',
                'id_cargo_usuario' => '1',
            ]
        );


    }

}
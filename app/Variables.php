<?php
/**
 * Created by PhpStorm.
 * User: Juan Sebastian
 * Date: 20/07/2015
 * Time: 1:31 PM
 */

namespace App;


class Variables
{

    public function UserEnVerificacion()
    {
        $estadoEnveificacion = 'ENV';
        return $estadoEnveificacion;
    }

    public function UserRegistrado()
    {
        $estadoRegistrado = 'REG';
        return $estadoRegistrado;
    }

}
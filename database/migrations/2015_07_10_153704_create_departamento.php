<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDepartamento extends Migration {

    /**
     * Crear la Migracion.
     * Migracion Para la Creacion de la Tabla Departamento a traves del método Up
     * @return void
     */
    public function up()
    {
        Schema::create('departamento',function(Blueprint $table){

            $table->increments('id');
            $table->integer('cod_dane_dep');
            $table->string('nom_departamento',100);

        });
    }

    /**
     * Eliminar la Migracion.
     * Se Elimina la Tabla en Caso de Requerirse así
     */
    public function down()
    {

        Schema::drop('departamento');
    }

}


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMunicipio extends Migration {

    /**
     * Crear la Migracion.
     * Migracion Para la Creacion de la Tabla municipio a traves del método Up y el comando de Laravel DB::STAMENT
     * @return void
     */
    public function up()
    {
        Schema::create('municipio',function(Blueprint $table){

            $table->increments('id');
            $table->integer('cod_dane_mun')->unique();
            $table->string('nom_municipio',100)->unique();
            $table->integer('id_departamento')->unsigned();


            $table->foreign('id_departamento')
                ->references('id')->on('departamento')
                ->onDelete('restrict')
                ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     * Se Elimina la Tabla MUNICIPIO en Caso de Requerirse así a traves del metodo down()
     * @return void
     */
    public function down()
    {
        Schema::drop('municipio');
    }

}

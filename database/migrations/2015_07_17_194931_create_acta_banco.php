<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActaBanco extends Migration {

    /**
     * Migracion para crear la tabla ACTA BANCO en la base de datos con todos sus atributos con el metodo up
     * @return void
     */
    public function up()
    {

        Schema::create('acta_banco',function(Blueprint $table){


            $table->increments('id');
            $table->text('documento_acta_banco');
            $table->integer('id_municipio')->unsigned();

            $table->foreign('id_municipio')
                ->references('id')->on('municipio')
                ->onDelete('restrict')
                ->onUpdate('cascade');

        });
    }

    /**
     * Metodo down para realizar el rollback de la migracion de la tabla ACTA BANCO
     */

    public function down()
    {
        Schema::drop('acta_banco');
    }

}

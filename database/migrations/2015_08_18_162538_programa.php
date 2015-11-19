<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Programa extends Migration {

	/**
	 * Run the migrations.
     * Migracion para crear la tabla programa en la base de datos con todos sus atributos con el metodo up
	 * @return void
	 */
	public function up()
	{
        Schema::create('programa', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('codigo_programa');
            $table->string('nombre_programa',200);
            $table->integer('id_eje_estrategico')->unsigned();

            $table->foreign('id_eje_estrategico')
                ->references('id')->on('eje_estrategico')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
	}

	/**
	 * Reverse the migrations.
     * metodo down para realizar el rollback de la migracion de la tabla programa.
	 * @return void
	 */
	public function down()
	{
        Schema::drop('programa');
	}

}

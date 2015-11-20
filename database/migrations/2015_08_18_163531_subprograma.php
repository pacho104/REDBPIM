<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Subprograma extends Migration {

	/**
	 * Run the migrations.
     * Migracion para crear la tabla subprograma en la base de datos con todos sus atributos con el metodo up
	 * @return void
	 */
	public function up()
	{
        Schema::create('sub_programa', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('codigo_sub_programa');
            $table->string('nombre_sub_programa',200);
            $table->integer('id_programa')->unsigned();

            $table->foreign('id_programa')
                ->references('id')->on('programa')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
	}

	/**
	 * Reverse the migrations.
     * metodo down para realizar el rollback de la migracion de la tabla subprograma.
	 * @return void
	 */
	public function down()
	{
        Schema::drop('sub_programa');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MetaProgramas extends Migration {

	/**
	 * Run the migrations.
     * Migracion para crear la tabla meta prgrmamas en la base de datos con todos sus atributos con el metodo up
	 * @return void
	 */
    public function up()
	{
        Schema::create('meta_programas', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('id_programa')->unsigned();
            $table->integer('id_meta')->unsigned();

            $table->foreign('id_programa')
                ->references('id')->on('programa')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_meta')
                ->references('id')->on('meta')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
	}

	/**
	 * Reverse the migrations.
     * metodo down para realizar el rollback de la migracion de la tabla meta programas
	 * @return void
	 */
	public function down()
	{
        Schema::drop('meta_programas');
	}

}

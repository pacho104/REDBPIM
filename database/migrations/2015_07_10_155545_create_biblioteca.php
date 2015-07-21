<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBiblioteca extends Migration {

	/**
	 * Run the migrations.
	 * Migracion para crear la tabla biblioteca en la base de datos con todos sus atributos con el metodo up
	 * @return void
	 */
	public function up()
	{
        Schema::create('biblioteca', function (Blueprint $table) {

            $table->increments('id');
            $table->string('titulo_biblioteca', 100);
            $table->text('documento_biblioteca');
        });

	}

	/**
	 * Reverse the migrations.
	 * metodo down para realizar el rollback de la migracion de la tabla biblioteca
	 * @return void
	 */
	public function down()
	{

        Schema::drop('biblioteca');

	}

}

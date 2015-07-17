<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargoUsuario extends Migration {

	/**
	 * Run the migrations.
	 *
     * Migracion para crear la tabla cargo de usuario en la base de datos con todos sus atributos con el metodo up
	 * @return void
	 */
	public function up()
	{
        Schema::create('cargo_usuario',function(Blueprint $table){


            $table->increments('id');
            $table->string('nom_cargo',100);

        });

	}

	/**
	 * Reverse the migrations.
	 * metodo down para realizar el rollback de la migracion de la tabla cargo_usuario
	 * @return void
	 */
	public function down()
    {

        Schema::drop('cargo_usuario');


    }
}

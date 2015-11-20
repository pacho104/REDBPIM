<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Meta extends Migration {

	/**
	 * Run the migrations.
     * Migracion para crear la tabla meta en la base de datos con todos sus atributos con el metodo up
	 * @return void
	 */
	public function up()
	{
        Schema::create('meta', function (Blueprint $table) {

            $table->increments('id');
            $table->string('nombre_meta',45);
            $table->string('tipo_meta',45);
            $table->integer('valor_meta');
        });
	}

	/**
	 * Reverse the migrations.
	 * metodo down para realizar el rollback de la migracion de la tabla meta.
	 * @return void
	 */
	public function down()
	{
        Schema::drop('meta');
	}

}

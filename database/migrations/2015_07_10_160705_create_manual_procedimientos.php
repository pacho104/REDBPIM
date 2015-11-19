<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateManualProcedimientos extends Migration {

	/**
	 * Run the migrations.
	 *Migracion para crear la tabla manual_procedimientos en la base de datos con todos sus atributos con el metodo up
	 * @return void
	 */
	public function up()
	{
        Schema::create('manual_procedimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom_manual', 100);
            $table->text('documento_manual');
            $table->integer('id_departamento')->unsigned();

            $table->foreign('id_departamento')
                ->references('id')->on('departamento')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 * metodo down para realizar el rollback de la migracion de la tabla manual_procedimientos
	 * @return void
	 */
	public function down()
	{
        Schema::drop('manual_procedimientos');

	}

}

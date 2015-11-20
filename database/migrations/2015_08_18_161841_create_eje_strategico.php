<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEjeStrategico extends Migration {

	/**
	 * Run the migrations.
     * Migracion para crear la tabla eje estrategico en la base de datos con todos sus atributos con el metodo up
	 * @return void
	 */
	public function up()
	{
        Schema::create('eje_estrategico', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('codigo_eje');
            $table->string('nombre_eje',200);
            $table->integer('id_plan_de_desarrollo')->unsigned();

            $table->foreign('id_plan_de_desarrollo')
                ->references('id')->on('plan_de_desarrollo')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
	}

	/**
	 * Reverse the migrations.
     * metodo down para realizar el rollback de la migracion de la tabla eje estrategico.
	 * @return void
	 */
	public function down()
	{
        Schema::drop('eje_estrategico');
	}

}

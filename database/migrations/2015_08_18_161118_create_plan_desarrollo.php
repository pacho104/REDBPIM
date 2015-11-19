<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanDesarrollo extends Migration {

	/**
	 * Run the migrations.
     * Migracion para crear la tabla plan de desarrollo en la base de datos con todos sus atributos con el metodo up
	 * @return void
	 */
	public function up()
	{
        Schema::create('plan_de_desarrollo', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('codigo_plan');
            $table->text('nombre_plan');
            $table->integer('id_municipio')->unsigned();

            $table->foreign('id_municipio')
                ->references('id')->on('municipio')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
	}

	/**
	 * Reverse the migrations.
     * metodo down para realizar el rollback de la migracion de la tabla plan de desarrollo
	 * @return void
	 */
	public function down()
	{
        Schema::drop('plan_de_desarrollo');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesoProyectoTable extends Migration {

    /**
    * Run the migrations.
    *
    * @return void
    */
	public function up()
	{
        Schema::create('proceso_proyecto', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('id_proyecto_general')->unsigned();
            $table->integer('id_proceso')->unsigned();

            $table->foreign('id_proyecto_general')
                  ->references('id')->on('proyecto_general')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->foreign('id_proceso')
                  ->references('id')->on('proceso')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('proceso_proyecto');
	}

}

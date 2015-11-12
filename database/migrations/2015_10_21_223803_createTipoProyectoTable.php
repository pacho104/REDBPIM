<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoProyectoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('tipo_proyecto', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('nom_tipo_proyecto',200);
            $table->integer('consecutivo_tipo_proyecto');
            $table->integer('tiempo_eje_tipo_proyecto');
            $table->integer('id_banco')->unsigned();

            $table->foreign('id_banco')
                  ->references('id')->on('banco')
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
        Schema::drop('tipo_proyecto');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoGeneralTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('proyecto_general', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('nombre_proyecto',200);
            $table->integer('codigo_bpi');
            $table->date('fecha_proyecto');
            $table->string('vigencia_proyecto', 4);
            $table->string('declaratoria_emergencia',200);

            $table->integer('id_tipo_proyecto')->unsigned();

            $table->foreign('id_tipo_proyecto')
                  ->references('id')->on('tipo_proyecto')
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
        Schema::drop('proyecto_general');
	}

}

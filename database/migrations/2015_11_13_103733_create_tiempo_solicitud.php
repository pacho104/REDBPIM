<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiempoSolicitud extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('tiempo_solicitud', function (Blueprint $table) {

            $table->increments('id');
            $table->string('nom_solicitud', 255);
            $table->integer('tiempo');
            $table->integer('id_municipio')->unsigned();
            $table->timestamps();

            $table->foreign('id_municipio')
                ->references('id')->on('municipio')
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
		 Schema::drop('tiempo_solicitud');
	}

}

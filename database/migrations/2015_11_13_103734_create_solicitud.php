<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitud extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('solicitud', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom_solicitud', 255);
            $table->integer('num_solicitud');
            $table->integer('id_formato_solicitud')->unsigned();
            $table->integer('id_formato_email')->unsigned();
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_municipio')->unsigned();
            $table->integer('id_tiempo_solicitud')->unsigned();

            $table->timestamps();


            $table->foreign('id_formato_solicitud')
                ->references('id')->on('formato_solicitud')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_formato_email')
                ->references('id')->on('formato_email')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_usuario')
                ->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_municipio')
                ->references('id')->on('municipio')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_tiempo_solicitud')
                ->references('id')->on('tiempo_solicitud')
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
		Schema::drop('solicitud');
	}

}

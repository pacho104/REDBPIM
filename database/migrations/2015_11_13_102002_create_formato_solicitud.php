<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormatoSolicitud extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('formato_solicitud', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom_formato_solicitud', 255);
            $table->text('cuerpo_formato_solicitud');
            $table->integer('consecutivo_formato_solicitud');
            $table->timestamps();



        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
             Schema::drop('formato_solicitud');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormatoEmail extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        Schema::create('formato_email', function (Blueprint $table) {

            $table->increments('id');
            $table->string('nom_formato', 255);
            $table->string('asunto', 255);
            $table->text('cuerpo');
            $table->string('email_origen');
            $table->string('email_destino');


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
        Schema::drop('formato_email');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroEnvio extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('registro_envio', function (Blueprint $table) {

            $table->increments('id');
            $table->timestamps();
            $table->integer('id_formato_email')->unsigned();

            $table->foreign('id_formato_email')
                ->references('id')->on('formato_email')
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
		  Schema::drop('registro_envio');
	}

}

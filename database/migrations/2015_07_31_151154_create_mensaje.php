<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensaje extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('mensaje',function(Blueprint $table){


            $table->increments('id');
            $table->text('texto_mensaje');
            $table->time('hora_mensaje');
            $table->date('fecha_mensaje');
            $table->integer('id_sala_chat')->unsigned();
            $table->integer('id_usuario')->unsigned();

            $table->foreign('id_sala_chat')
                ->references('id')->on('sala_chat')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_usuario')
                ->references('id')->on('users')
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
		    Schema::drop('mensaje');
	}

}

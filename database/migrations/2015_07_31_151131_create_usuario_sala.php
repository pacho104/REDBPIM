<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioSala extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('usuario_sala',function(Blueprint $table){


            $table->increments('id');
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
		Schema::drop('usuario_sala');
	}

}

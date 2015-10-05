<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaChat extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('sala_chat',function(Blueprint $table){


            $table->increments('id');
            $table->string('nombre_sala_chat');
            $table->boolean('estado_sala_chat')->default(false);
            $table->integer('usuario_id_usuario')->unsigned();


            $table->foreign('usuario_id_usuario')
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
		Schema::drop('sala_chat');
	}

}

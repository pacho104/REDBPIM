<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtapaLista extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('etapa_lista',function(Blueprint $table){

            $table->increments('id');
            $table->String('nom_etapa');
            $table->integer('recurso_id_recurso')->unsigned();

            $table->unique(array('nom_etapa', 'recurso_id_recurso'));


            $table->foreign('recurso_id_recurso')
                ->references('id')->on('recurso')
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
        Schema::drop('etapa_lista');
	}

}

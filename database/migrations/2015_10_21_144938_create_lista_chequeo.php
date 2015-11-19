<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListaChequeo extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_chequeo',function(Blueprint $table){

            $table->increments('id');
            $table->string('nom_lista');
            $table->integer('tipo_lista')->unsigned();
            $table->integer('sector_inversion_id_sector')->unsigned();
            $table->integer('etapa_lista_id_etapa')->unsigned();
            $table->integer('proceso_id_proceso')->unsigned();
            $table->integer('municipio_id_municipio')->unsigned()->nullable();
            $table->timestamps();


            $table->foreign('tipo_lista')
                ->references('id')->on('tipo')
                ->onDelete('restrict')
                ->onUpdate('cascade');


            $table->foreign('sector_inversion_id_sector')
                ->references('id')->on('sector_inversion')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('etapa_lista_id_etapa')
                ->references('id')->on('etapa_lista')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('proceso_id_proceso')
                ->references('id')->on('proceso')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('municipio_id_municipio')
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
        Schema::drop('lista_chequeo');
    }

}
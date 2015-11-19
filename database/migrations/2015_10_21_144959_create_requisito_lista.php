<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitoLista extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisito_lista',function(Blueprint $table){


            $table->increments('id');
            $table->integer('id_requisito')->unsigned();
            $table->integer('id_lista_chequeo')->unsigned();

            $table->unique(array('id_requisito', 'id_lista_chequeo'));


            $table->foreign('id_requisito')
                ->references('id')->on('requisito')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_lista_chequeo')
                ->references('id')->on('lista_chequeo')
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
        Schema::drop('requisito_lista');
    }

}
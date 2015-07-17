<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRedDepartamental extends Migration {

    /**
     * Run the migrations.
     * Migracion para crear la tabla red_departamental en la base de datos con todos sus atributos con el metodo up
     * @return void
     */
    public function up()
    {

        Schema::create('red_departamental',function(Blueprint $table){


            $table->increments('id');
            $table->integer('id_biblioteca')->unsigned();
            $table->integer('id_noticia')->unsigned();
            $table->integer('id_departamento')->unsigned();
            $table->integer('id_manual_procedimiento')->unsigned();

            $table->foreign('id_biblioteca')
                ->references('id')->on('biblioteca')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_noticia')
                ->references('id')->on('noticia')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_departamento')
                ->references('id')->on('departamento')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_manual_procedimiento')
                ->references('id')->on('manual_procedimientos')
                ->onDelete('restrict')
                ->onUpdate('cascade');


        });
    }

    /**
     * Reverse the migrations.
     * metodo down para realizar el rollback de la migracion de la tabla red_departamental
     * @return void
     */
    public function down()
    {
        Schema::drop('red_departamental');
    }

}

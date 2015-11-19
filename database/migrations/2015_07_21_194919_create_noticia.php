<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNoticia extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('noticia', function (Blueprint $table) {

            $table->increments('id');
            $table->string('titulo_noticia', 150);
            $table->text('cuerpo_noticia');
            $table->integer('id_departamento')->unsigned();

            $table->foreign('id_departamento')
                ->references('id')->on('departamento')
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
        //Se Elimina la Tabla en Caso de Requerirse así

        Schema::drop('noticia');
        //DB::statement('DROP TABLE redbpim.noticia');
    }

}
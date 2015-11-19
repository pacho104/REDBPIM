<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisito extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisito',function(Blueprint $table){

            $table->increments('id');
            $table->text('nom_requisito');
            $table->boolean('obligatorio');
            $table->integer('municipio_id_municipio')->unsigned()->nullable();



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
        Schema::drop('requisito');
    }

}

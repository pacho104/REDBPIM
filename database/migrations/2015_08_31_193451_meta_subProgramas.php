<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MetaSubProgramas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('meta_subProgramas', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('id_sub_programa')->unsigned();
            $table->integer('id_meta')->unsigned();

            $table->foreign('id_sub_programa')
                    ->references('id')->on('sub_programa')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');

            $table->foreign('id_meta')
                    ->references('id')->on('meta')
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
        Schema::drop('meta_subProgramas');
	}

}

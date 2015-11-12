<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBancoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('banco', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('nombre_banco',100);
            $table->string('codigo_banco',20);
            $table->string('vigencia_banco', 4);
            $table->date('fecha_banco');
            $table->integer('id_municipio')->unsigned();

            $table->foreign('id_municipio')
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
        Schema::drop('banco');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormatoEvidencia extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('formato_evidencia', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nom_formato',255);
			$table->text('encabezado_formato');
			$table->longText('cuerpo_formato');
			$table->integer('id_logo')->unsigned()->nullable();

			//$table->timestamps();

            $table->foreign('id_logo')
                ->references('id')->on('logo')
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
		Schema::drop('formato_evidencia');
	}

}

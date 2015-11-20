<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevision extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('revision', function (Blueprint $table) {

            $table->increments('id');
            $table->string('tipo_revision');
            $table->integer('num_solicitud');
            $table->integer('id_usuario_revisa')->unsigned();
            $table->integer('id_concepto')->unsigned();
            $table->integer('id_documento_evi')->unsigned();
            $table->integer('id_formato_evi')->unsigned();
            $table->integer('id_solicitud')->unsigned();
            $table->timestamps();


            $table->foreign('id_usuario_revisa')
                ->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_concepto')
                ->references('id')->on('concepto')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_documento_evi')
                ->references('id')->on('documento_evidencia')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_formato_evi')
                ->references('id')->on('formato_evidencia')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_solicitud')
                ->references('id')->on('solicitud')
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
		Schema::drop('revision');
	}

}

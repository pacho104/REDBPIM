<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipoSecretaria extends Migration {

	/**
     * Cargar la migracion.
     * Migracion Para la Creacion de la Tabla TIPO SECRETARIA a través del metodo up
	 * @return void
	 */
	public function up()
	{
        Schema::create('tipo_secretaria',function(Blueprint $table){

            $table->increments('id');
            $table->string('nombre_secretaria',60);

        });

	}

	/**
     * Eliminar la Migracion.
	 *
	 * @return void
	 */
	public function down()
	{
		//Se Elimina la Tabla en Caso de Requerirse así

        Schema::drop('tipo_secretaria');

	}

}

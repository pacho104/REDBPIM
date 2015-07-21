<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipoIdentificacion extends Migration {

	/**
     * Crear la Migracion.
     * Migracion Para la Creacion de la Tabla Tipo Identificación con el método up()
     * @return void
	 */
	public function up()
	{

        Schema::create('tipo_identificacion', function (Blueprint $table) {

            $table->increments('id');
            $table->string('nom_identificacion', 45)->unique();

        });

	}

	/**
     * Eliminar la Migracion.
     * Se Elimina la Tabla Tipo Identificacion en caso de Requerirse así
	 * @return void
	 */
	public function down()
	{
        Schema::drop('tipo_identificacion');
	}

}

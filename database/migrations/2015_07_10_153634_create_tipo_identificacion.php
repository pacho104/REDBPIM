<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoIdentificacion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        //Migracion Para la Creacion de la Tabla Tipo Identificación

        DB::statement('CREATE TABLE IF NOT EXISTS redbpim.tipo_identificacion (
                      id INT NOT NULL AUTO_INCREMENT,
                      nom_identificacion VARCHAR(45) NOT NULL,
                      PRIMARY KEY (id))
                      ENGINE = InnoDB');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        //Se Elimina la Tabla en Caso de Requerirse así

            DB::statement('DROP TABLES redbpim.tipo_identificacion') ;

	}

}

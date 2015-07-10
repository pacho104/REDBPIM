<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoSecretaria extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// //Migracion Para la Creacion de la Tabla Tipo Secretaria

        DB::statement('CREATE TABLE IF NOT EXISTS RedBpim.tipo_secretaria (
                      id INT NOT NULL AUTO_INCREMENT,
                      nombre_secretaria VARCHAR(60) NOT NULL,
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

        DB::statement('DROP TABLES redbpim.tipo_secretaria') ;
	}

}

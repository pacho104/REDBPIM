<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartamento extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Migracion Para la Creacion de la Tabla Departamento

        DB::statement('CREATE TABLE IF NOT EXISTS redbpim.departamento (
                      id INT NOT NULL AUTO_INCREMENT,
                      cod_dane_dep INT NOT NULL,
                      nom_departamento VARCHAR(100) NOT NULL,
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

        DB::statement('DROP TABLES redbpim.departamento') ;
	}

}

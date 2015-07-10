<?php

use Illuminate\Database\Migrations\Migration;

class CreateDepartamento extends Migration {

	/**
     * Crear la Migracion.
     * Migracion Para la Creacion de la Tabla Departamento a traves del método Up
     * @return void
	 */
	public function up()
	{
        DB::statement('CREATE TABLE IF NOT EXISTS redbpim.departamento (
                      id INT NOT NULL AUTO_INCREMENT,
                      cod_dane_dep INT NOT NULL,
                      nom_departamento VARCHAR(100) NOT NULL,
                      PRIMARY KEY (id))
                      ENGINE = InnoDB');
    }

	/**
     * Eliminar la Migracion.
     * Se Elimina la Tabla en Caso de Requerirse así
     */
	public function down()
	{
        DB::statement('DROP TABLE redbpim.departamento');
	}

}

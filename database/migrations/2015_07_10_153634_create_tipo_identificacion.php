<?php

use Illuminate\Database\Migrations\Migration;

class CreateTipoIdentificacion extends Migration {

	/**
     * Crear la Migracion.
     * Migracion Para la Creacion de la Tabla Tipo Identificación con el método up()
     * @return void
	 */
	public function up()
	{
        DB::statement('CREATE TABLE IF NOT EXISTS redbpim.tipo_identificacion (
                      id INT NOT NULL AUTO_INCREMENT,
                      nom_identificacion VARCHAR(45) NOT NULL,
                      PRIMARY KEY (id))
                      ENGINE = InnoDB');
	}

	/**
     * Eliminar la Migracion.
     * Se Elimina la Tabla Tipo Identificacion en caso de Requerirse así
	 * @return void
	 */
	public function down()
	{
        DB::statement('DROP TABLES redbpim.tipo_identificacion');
	}

}

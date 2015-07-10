<?php

use Illuminate\Database\Migrations\Migration;

class CreateMunicipio extends Migration {

	/**
     * Crear la Migracion.
     * Migracion Para la Creacion de la Tabla municipio a traves del método Up y el comando de Laravel DB::STAMENT
	 * @return void
	 */
	public function up()
	{
        DB::statement('CREATE TABLE IF NOT EXISTS redbpim.municipio (
                id INT NOT NULL AUTO_INCREMENT,
                cod_dane_mun INT NOT NULL,
                nom_municipio VARCHAR(100),
                id_departamento INT NOT NULL,
                PRIMARY KEY (id),
                CONSTRAINT fk_municipio_dep
                FOREIGN KEY (id_departamento)
                REFERENCES redbpim.departamento (id)
                ON DELETE RESTRICT
                ON UPDATE CASCADE)
                ENGINE = InnoDB');
	}

	/**
	 * Reverse the migrations.
     * Se Elimina la Tabla MUNICIPIO en Caso de Requerirse así a traves del metodo down()
	 * @return void
	 */
	public function down()
	{
        DB::statement('DROP TABLE redbpim.municipio');
	}

}

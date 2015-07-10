<?php

use Illuminate\Database\Migrations\Migration;

class CreateActaBanco extends Migration {

	/**
     * Migracion para crear la tabla ACTA BANCO en la base de datos con todos sus atributos con el metodo up
     * @return void
	 */
	public function up()
	{
		//
        DB::statement('CREATE TABLE IF NOT EXISTS redbpim.acta_banco (
              id INT NOT NULL AUTO_INCREMENT,
              documento_acta_banco VARCHAR(45) NOT NULL,
              id_municipio INT NOT NULL,
              PRIMARY KEY (idactaBanco),
              CONSTRAINT fk_acta_banco_mun
                FOREIGN KEY (id_municipio)
                REFERENCES redbpim.municipio (id)
                ON DELETE RESTRICT
                ON UPDATE CASCADE)
            ENGINE = InnoDB ');

	}

	/**
     * Metodo down para realizar el rollback de la migracion de la tabla ACTA BANCO
	 */

	public function down()
	{
        DB::statement('DROP TABLES redbpim.acta_banco');
	}

}

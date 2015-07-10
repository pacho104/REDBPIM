<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActaBanco extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        DB::statement('CREATE TABLE IF NOT EXISTS redbpim.actaBanco (
  idactaBanco INT NOT NULL AUTO_INCREMENT,
  documentoActaBanco VARCHAR(45) NOT NULL,
  IdMunicipio INT NOT NULL,
  PRIMARY KEY (idactaBanco),
  CONSTRAINT fkActBancoMun
    FOREIGN KEY (IdMunicipio)
    REFERENCES redbpim.municipio (idMunicipio)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB');

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}

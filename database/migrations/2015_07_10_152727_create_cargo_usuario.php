<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargoUsuario extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::statement('CREATE TABLE IF NOT EXISTS redbpim.cargo_usuario(
                    id INT NOT NULL AUTO_INCREMENT,
                    nom_cargo VARCHAR(100) NOT NULL,
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

        DB::statement(' DROP TABLE IF EXISTS redbpim.cargo_usuario');

    }
}

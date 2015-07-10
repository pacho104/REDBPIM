<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargoUsuario extends Migration {

	/**
	 * Run the migrations.
	 *
     * Migracion para crear la tabla cargo de usuario en la base de datos con todos sus atributos con el metodo up
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
	 * metodo down para realizar el rollback de la migracion de la tabla cargo_usuario
	 * @return void
	 */
	public function down()
    {

        DB::statement('DROP TABLE IF EXISTS redbpim.cargo_usuario');

    }
}

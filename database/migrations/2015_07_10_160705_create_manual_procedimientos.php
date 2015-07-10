<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManualProcedimientos extends Migration {

	/**
	 * Run the migrations.
	 *Migracion para crear la tabla manual_procedimientos en la base de datos con todos sus atributos con el metodo up
	 * @return void
	 */
	public function up()
	{
        DB::statement('CREATE TABLE IF NOT EXISTS redbpim.manual_procedimientos (
                          id INT NOT NULL AUTO_INCREMENT,
                          nom_manual VARCHAR(100) NOT NULL,
                          documento_manual VARCHAR(150) NOT NULL,
                          PRIMARY KEY (id))
                          ENGINE = InnoDB');
	}

	/**
	 * Reverse the migrations.
	 * metodo down para realizar el rollback de la migracion de la tabla manual_procedimientos
	 * @return void
	 */
	public function down()
	{
        DB::statement('DROP TABLE IF EXISTS redbpim.manual_procedimientos') ;
	}

}

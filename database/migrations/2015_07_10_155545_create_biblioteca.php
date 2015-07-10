<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiblioteca extends Migration {

	/**
	 * Run the migrations.
	 * Migracion para crear la tabla biblioteca en la base de datos con todos sus atributos con el metodo up
	 * @return void
	 */
	public function up()
	{
        DB::statement('CREATE TABLE IF NOT EXISTS redbpim.biblioteca (
                    id INT NOT NULL AUTO_INCREMENT,
                    titulo_biblioteca VARCHAR(100) NOT NULL,
                    documento_biblbioteca TEXT NOT NULL,
                    PRIMARY KEY (id))
                    ENGINE = InnoDB');

	}

	/**
	 * Reverse the migrations.
	 * metodo down para realizar el rollback de la migracion de la tabla biblioteca
	 * @return void
	 */
	public function down()
	{
        DB::statement('DROP TABLE IF EXISTS redbpim.biblioteca') ;
	}

}

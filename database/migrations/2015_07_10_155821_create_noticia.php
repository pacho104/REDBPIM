<?php

use Illuminate\Database\Migrations\Migration;

class CreateNoticia extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        //Migracion Para la Creacion de la Tabla Noticia

        DB::statement('CREATE TABLE IF NOT EXISTS redbpim.noticia (
                      id INT NOT NULL AUTO_INCREMENT,
                      titulo_noticia VARCHAR(150) NOT NULL,
                      cuerpo_noticia TEXT NOT NULL,
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

        DB::statement('DROP TABLES redbpim.noticia');
	}

}

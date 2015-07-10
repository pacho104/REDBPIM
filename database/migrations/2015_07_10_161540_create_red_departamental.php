<?php

use Illuminate\Database\Migrations\Migration;

class CreateRedDepartamental extends Migration {

	/**
	 * Run the migrations.
	 * Migracion para crear la tabla red_departamental en la base de datos con todos sus atributos con el metodo up
	 * @return void
	 */
	public function up()
	{
        DB::statement('CREATE TABLE IF NOT EXISTS redbpim.red_departamental (
                          id INT NOT NULL AUTO_INCREMENT,
                          id_biblioteca INT NOT NULL,
                          id_noticia INT NOT NULL,
                          id_departamento INT NOT NULL,
                          id_manual_procedimientos INT NOT NULL,
                          PRIMARY KEY (id),
                          CONSTRAINT fk_biblioteca_secretaria
                            FOREIGN KEY (id_biblioteca)
                            REFERENCES redbpim.biblioteca (id)
                            ON DELETE RESTRICT
                            ON UPDATE CASCADE,
                          CONSTRAINT fk_noticia_secretaria
                            FOREIGN KEY (id_noticia)
                            REFERENCES redbpim.noticia (id)
                            ON DELETE RESTRICT
                            ON UPDATE CASCADE,
                          CONSTRAINT fk_red_departamental_dep
                            FOREIGN KEY (id_departamento)
                            REFERENCES redbpim.departamento (id)
                            ON DELETE RESTRICT
                            ON UPDATE CASCADE,
                          CONSTRAINT fk_red_departamental_manual_proce
                            FOREIGN KEY (id_manual_procedimientos)
                            REFERENCES redbpim.manual_procedimientos (id)
                            ON DELETE RESTRICT
                            ON UPDATE CASCADE)
                            ENGINE = InnoDB');

                            DB::statement('CREATE INDEX biblioteca_secretaria_idx ON redbpim.red_departamental (id_biblioteca ASC)');

                            DB::statement('CREATE INDEX noticia_secretaria_idx ON redbpim.red_departamental (id_noticia ASC)');

                            DB::statement('CREATE INDEX fk_red_departamental_departamento1_idx ON redbpim.red_departamental (id_departamento ASC)');

        DB::statement('CREATE INDEX fk_red_departamental_manual_procedimientos1_idx ON redbpim.red_departamental (id_manual_procedimientos ASC)');

	}

	/**
	 * Reverse the migrations.
	 * metodo down para realizar el rollback de la migracion de la tabla red_departamental
	 * @return void
	 */
	public function down()
	{
        DB::statement('DROP TABLE IF EXISTS redbpim.red_departamental') ;
	}

}

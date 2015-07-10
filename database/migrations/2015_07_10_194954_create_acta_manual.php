<?php

use Illuminate\Database\Migrations\Migration;

class CreateActaManual extends Migration {

	/**
	 * Run the migrations.
	 * Migracion para crear la tabla acta_manual en la base de datos con todos sus atributos con el metodo up
	 * @return void
	 */
	public function up()
	{
        DB::statement('CREATE TABLE IF NOT EXISTS redbpim.acta_manual (
                          id INT NOT NULL AUTO_INCREMENT,
                          acta_banco_id_acta_banco INT NOT NULL,
                          man_proced_id_man_proced INT NOT NULL,
                          PRIMARY KEY (id),
                          CONSTRAINT fk_act_manl_act_banco
                            FOREIGN KEY (acta_banco_id_acta_banco)
                            REFERENCES redbpim.acta_banco (id)
                            ON DELETE RESTRICT
                            ON UPDATE CASCADE,
                            CONSTRAINT fk_acta_manl_man_procd
                            FOREIGN KEY (man_proced_id_man_proced)
                            REFERENCES redbpim.manual_procedimientos (id)
                            ON DELETE RESTRICT
                            ON UPDATE CASCADE)
                        ENGINE = InnoDB');

        DB::statement('CREATE INDEX fk_acta_manual_banco1_idx ON redbpim.acta_manual (acta_banco_id_acta_banco ASC) ');

        DB::statement('CREATE INDEX fk_acta_manual_procedimientos1_idx ON redbpim.acta_manual (man_proced_id_man_proced ASC) ');
	}

	/**
	 * Reverse the migrations.
	 * metodo down para realizar el rollback de la migracion de la tabla acta_manual
	 * @return void
	 */
	public function down()
    {
        DB::statement('DROP TABLE IF EXISTS redbpim.acta_manual');
    }
}

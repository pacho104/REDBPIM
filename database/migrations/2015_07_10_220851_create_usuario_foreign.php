<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioForeign extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
    {
        DB::statement('ALTER TABLE users ADD CONSTRAINT fk_usuario_municipio FOREIGN KEY (id_municipio) REFERENCES municipio (id) ON UPDATE CASCADE');
        DB::statement('ALTER TABLE users ADD CONSTRAINT fk_tipo_secretaria_aplica FOREIGN KEY (id_tipo_secretaria) REFERENCES tipo_secretaria (id) ON UPDATE CASCADE');
        DB::statement('ALTER TABLE users ADD CONSTRAINT fk_usuario_tipo_identificacion FOREIGN KEY (id_tipo_identificacion) REFERENCES tipo_identificacion (id) ON UPDATE CASCADE');
        DB::statement('ALTER TABLE users ADD CONSTRAINT fk_usuario_cargo_usuario FOREIGN KEY (id_cargo_usuario) REFERENCES cargo_usuario (id) ON UPDATE CASCADE');
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

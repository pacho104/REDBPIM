<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->integer('id',true,false);
            $table->string('name');
            $table->string('ape_usuario', 60);
            $table->string('num_identificacion', 20);
            $table->string('tel_usuario', 30);
            $table->string('cel_usuario', 30);
            $table->string('user_login')->unique();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->integer('id_municipio',false,false);
            $table->integer('id_tipo_secretaria',false,false);
            $table->integer('id_tipo_identificacion',false,false);
            $table->integer('id_cargo_usuario',false,false);;
            $table->rememberToken();
            $table->timestamps();
        });

        DB::statement('CREATE INDEX UsuarioMunicipio_idx ON redbpim.users (id_municipio ASC) ');

        DB::statement('CREATE INDEX TipoSecretariaAplica_idx ON redbpim.users (id_tipo_secretaria ASC) ');

        DB::statement('CREATE INDEX fk_usuario_tipoIdentificacion1_idx ON redbpim.users (id_tipo_identificacion ASC) ');

        DB::statement('CREATE INDEX fk_usuario_cargoUsuario1_idx ON redbpim.users (id_cargo_usuario ASC) ');

    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
        	}

}

<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

        $this->call('CargoUsuarioTableSeeder');
        $this->call('DepartamentoTableSeeder');
        $this->call('MunicipioTableSeeder');
        $this->call('TipoIdentificacionTableSeeder');
        $this->call('TipoSecretariaTableSeeder');
        $this->call('AsignarRolesTableSeeder');

	}

}

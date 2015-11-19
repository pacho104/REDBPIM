<?php namespace App\Services;

use App\RolesUsers;
use App\User;
use App\Variables;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use Validator;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */

    public function validator(array $data)
	{
		return Validator::make($data, [
			'nombres' => 'required|max:255',
            'apellidos' => 'required|max:100',
            'numero_identificacion' => 'required|numeric|unique:users,num_identificacion',
            'tel_usuario' => 'max:30',
            'cel_usuario' => 'max:30',
			'correo_electronico' => 'required|email|max:255|unique:users,email',
            'nombre_usuario' => 'required|max:255|unique:users,user_login',
            'contrasenia' => 'required|confirmed|min:6',
            'g-recaptcha-response' => 'required|captcha',
            'municipio' => 'exists:municipio,id',
            'secretaria' => 'exists:tipo_secretaria,id',
            'cargo_usuario' => 'exists:cargo_usuario,id',
            'tipo_identificacion' => 'exists:tipo_identificacion,id',

		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
        $estado = new Variables();

      		return User::create([
			'nom_usuario' => $data['nombres'],
            'ape_usuario' => $data['apellidos'],
            'num_identificacion' => $data['numero_identificacion'],
            'tel_usuario' => $data['telefono_usuario'],
            'cel_usuario' => $data['celular_usuario'],
            'user_login' => $data['nombre_usuario'],
			'email' => $data['correo_electronico'],
			'password' => bcrypt($data['contrasenia']),
            'estado_user' => $estado->UserEnVerificacion(),
            'id_municipio' => $data['municipio'],
            'id_tipo_secretaria' => $data['secretaria'],
            'id_tipo_identificacion' => $data['tipo_identificacion'],
            'id_cargo_usuario' => $data['cargo_usuario'],
		]);
	}

    public function createRole(array $data)
    {
        $getid = \DB::table('users')->where('email', '=', $data['correo_electronico'])
            ->where('user_login', '=', $data['nombre_usuario'])
            ->where('num_identificacion', '=', $data['numero_identificacion'])->first();

        return RolesUsers::create([
            'user_id' => $getid->id,
            'role_id' => $data['rol_usuario'],
        ]);
    }
}

<?php namespace App\Http\Controllers;

use App\CargoUsuario;
use App\Http\Requests;
use App\Secretaria;
use App\TipoIdentificacion;
use App\User;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Realiza el cierre de sesión cuando el usuario ingrese a este evento
     * limpia todas las sesiones que hayan sido utilizadas por el usuario durante el logueo
     * redirecciona a la vidta principal del usuario en este caso redirect login
     */
    public function logout()
    {
        session()->regenerate();
        \Auth::logout();
        return \Redirect::route('login_user');
    }

    /**
     * Funcioón que determina la vista principal del usuario en cada secretaría
     * Si el usuario accede con el rol de Secretaria Sectorial (1) ingresa a la view secSectorial
     * Si el usuario accede con el rol de Secretaria Departamental (2) ingresa a la view secMunicipal
     * Si el usuario accede con el rol de Secretaria Departamental (3) ingresa a la view secDepartamental
     */
    public function desktop()
    {
        $rol_selected = \Session::get('key');

        if ($rol_selected === '3') {
            return view('desktop_SecDepartamental');
        }
        if ($rol_selected === '2') {
            return view('desktop_SecMunicipal');
        }
        if ($rol_selected === '1') {
            return view('desktop_SecSectorial');
        }
    }

    /**
     * Permite editar la información de un usuario autenticado en el sistema
     * Obtiene la información necesaria para actualziar la informacion de usuario
     * de las tablas tipo_secretaria,cargo_usuario,tipo_identificación
     * @return Vista principal para realizar el proceso de actualización de información
     */
    public function edit()
    {
        $list_secretaria = Secretaria::lists('nombre_secretaria', 'id');
        $list_cargo = CargoUsuario::lists('nom_cargo', 'id');
        $list_tipidentificacion = TipoIdentificacion::lists('nom_identificacion', 'id');

        //Obtiene toda la informacion del usuario que se encuentra logueado al sistema.
        $user_refresh = \Auth::user();

        return view('template.partials.actualizar_info')
            ->with('list_secretaria', $list_secretaria)
            ->with('list_cargo', $list_cargo)
            ->with('list_tipidentificacion', $list_tipidentificacion)
            ->with('user_refresh', $user_refresh);
    }

    /**
     * Update la informacion de un user
     * Realiza las validaciones necesarias en cada campo utilizando las rules-laravel
     * y el recurso laravel - make \Validator
     * @param  int $id
     * @return Redirecciona a la vista principal del usuario route(login_user)
     */
    public function update($id)
    {
        $data = \Request::all();
        $rules = array(
            'nombres' => 'required|max:255',
            'apellidos' => 'required|max:100',
            'numero_identificacion' => "required|numeric|unique:users,num_identificacion,$id",
            'tel_usuario' => 'max:30',
            'cel_usuario' => 'max:30',
            'correo_electronico' => "required|email|max:255|unique:users,email,$id",
            'nombre_usuario' => "required|max:255|unique:users,user_login,$id",
            'secretaria' => 'exists:tipo_secretaria,id',
            'cargo_usuario' => 'exists:cargo_usuario,id',
            'tipo_identificacion' => 'exists:tipo_identificacion,id',
        );

        $error = \Validator::make($data, $rules);

        if ($error->fails()) {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

        $saveUser = User::find($id);
        $saveUser->nom_usuario = \Input::get('nombres');
        $saveUser->ape_usuario = \Input::get('apellidos');
        $saveUser->num_identificacion = \Input::get('numero_identificacion');
        $saveUser->tel_usuario = \Input::get('telefono_usuario');
        $saveUser->cel_usuario = \Input::get('celular_usuario');
        $saveUser->user_login = \Input::get('nombre_usuario');
        $saveUser->email = \Input::get('correo_electronico');
        $saveUser->id_tipo_secretaria = \Input::get('secretaria');
        $saveUser->id_tipo_identificacion = \Input::get('tipo_identificacion');
        $saveUser->id_cargo_usuario = \Input::get('cargo_usuario');
        $saveUser->save();

        return \Redirect::route('login_user')
            ->with('AlertUserUpdate', 'Actualización de información realizada exitosamente!');

    }


}

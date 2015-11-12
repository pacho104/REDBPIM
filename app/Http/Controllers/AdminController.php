<?php namespace App\Http\Controllers;

use App\CargoUsuario;
use App\Municipio;
use App\RolesUsers;
use App\Secretaria;
use App\User;
use App\Variables;

class AdminController extends Controller
{
    protected $variable;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function desktop()
    {
        return view('desktop_admin');
    }

    public function verificarUsuariosindex()
    {
        $variable = new Variables();

        if (\Auth::user()->level() == 5) {
            $userverif = \DB::table('users')
                ->join('municipio', 'municipio.id', '=', 'users.id_municipio')
                ->join('tipo_secretaria', 'tipo_secretaria.id', '=', 'users.id_tipo_secretaria')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->select('users.id', 'users.nom_usuario', 'users.ape_usuario',
                         'users.email', 'roles.description', 'municipio.nom_municipio',
                         'tipo_secretaria.nombre_secretaria')
                ->whereBetween('roles.level', array(2, 3))
                ->where('users.estado_user', '=', $variable->UserEnVerificacion())
                ->paginate(7);

            return view('template.Gestion_Usuarios.verificar_usuarios')
                ->with('userverif', $userverif);
        } elseif (\Auth::user()->level() == 4) {
            $userverif = \DB::table('users')
                ->join('municipio', 'municipio.id', '=', 'users.id_municipio')
                ->join('tipo_secretaria', 'tipo_secretaria.id', '=', 'users.id_tipo_secretaria')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->select('users.id', 'users.nom_usuario', 'users.ape_usuario',
                         'users.email', 'roles.description', 'municipio.nom_municipio',
                         'tipo_secretaria.nombre_secretaria')
                ->where('users.id_municipio', '=', \Auth::user()->id_municipio)
                ->where('roles.level', '=', '1')
                ->where('users.estado_user', '=', $variable->UserEnVerificacion())
                ->paginate(7);

            return view('template.Gestion_Usuarios.verificar_usuarios')
                ->with('userverif', $userverif);
        }
    }

    public function aceptarUsuario($id)
    {
        $variable = new Variables();
        $p = User::find($id);
        $p->estado_user = $variable->UserRegistrado();
        $p->save();

        return \Redirect::route('verificar_usuarios')
            ->with('alertAccept', 'El usuario ha sido registrado al sistema.!');
    }

    public function descartarUsuario($id)
    {
        $p = User::find($id)->delete();
        return \Redirect::route('verificar_usuarios')
            ->with('alertReject', 'El usuario ha sido descartado por el sistema!');
    }

    public function GestionRolIndex()
    {
        $list_cargo = CargoUsuario::lists('nom_cargo', 'id');
        $list_secretaria = Secretaria::lists('nombre_secretaria', 'id');
        $list_municipio = Municipio::lists('nom_municipio', 'id');

        return view('template.Gestion_Usuarios.roles_usuarios')
            ->with('list_cargo', $list_cargo)
            ->with('list_secretaria', $list_secretaria)
            ->with('list_municipio', $list_municipio);
    }

    public function storeRoles($id)
    {
        $level1 = \Input::get('user' . $id . 'level1');
        $level2 = \Input::get('user' . $id . 'level2');
        $level3 = \Input::get('user' . $id . 'level3');
        $level4 = \Input::get('user' . $id . 'level4');
        $level5 = \Input::get('user' . $id . 'level5');

        if ($level5 == false and $level4 == false and $level3 == false and $level2 == false and $level1 == false) {
            return $this->GestionRolesSearch()
                ->withErrors(['alertBadRol' => 'Debe asginar al menos un rol..!']);
        }
        if ($level5 == true or $level4 == true and $level1 == false and $level2 == false and $level3 == false) {
            return $this->GestionRolesSearch()
                ->withErrors(['alertBadRol' => 'El usuario no puede tener solo el rol de administrador. Verifique esto..!']);
        }
        if ($level5 == true and $level4 == true) {
            return $this->GestionRolesSearch()
                ->withErrors(['alertBadRol' => 'El usuario no puede tener dos roles de administrador..!']);
        }
        if ($level5 == true and $level2 == true) {
            return $this->GestionRolesSearch()
                ->withErrors(['alertBadRol' => 'El usuario no puede tener los roles de Administrador Departamental y Secretaria de Planeación Municipal. Verifique esto..!']);
        }
        if ($level4 == true and $level3 == true) {
            return $this->GestionRolesSearch()
                ->withErrors(['alertBadRol' => 'El usuario no puede tener los roles de Administrador Municipal y Secretaria de Planeación Departamental. Verifique esto..!']);
        }
        if ($level3 == true and $level2 == true) {
            return $this->GestionRolesSearch()
                ->withErrors(['alertBadRol' => 'El usuario no puede tener los roles de Secretaría de Planeación Departamental y Municipal. Verifique esto..!']);
        }

        if ($level1 == true and User::find($id)->hasRole('secsectorial') == false) {
            $saverol = new RolesUsers();
            $saverol->user_id = $id;
            $saverol->role_id = 1;
            $saverol->save();
        }

        if ($level2 == true and User::find($id)->hasRole('secmunicipal') == false) {
            $saverol = new RolesUsers();
            $saverol->user_id = $id;
            $saverol->role_id = 2;
            $saverol->save();
        }

        if ($level3 == true and User::find($id)->hasRole('secdepartamental') == false)
        {
            $saverol = new RolesUsers();
            $saverol->user_id = $id;
            $saverol->role_id = 3;
            $saverol->save();
        }

        if ($level4 == true and User::find($id)->hasRole('adminmunicipal') == false) {
            $saverol = new RolesUsers();
            $saverol->user_id = $id;
            $saverol->role_id = 4;
            $saverol->save();
        }

        if ($level5 == true and User::find($id)->hasRole('admin') == false) {
            $saverol = new RolesUsers();
            $saverol->user_id = $id;
            $saverol->role_id = 5;
            $saverol->save();
        }

        //ELIMINAR ROLES

        if ($level1 == false) {
            $deleteRol = \DB::table('role_user')
                ->where('user_id', '=', $id)
                ->where('role_id', '=', 1);
            $deleteRol->delete();
        }
        if ($level2 == false) {
            $deleteRol = \DB::table('role_user')
                ->where('user_id', '=', $id)
                ->where('role_id', '=', 2);
            $deleteRol->delete();
        }
        if ($level3 == false) {
            $deleteRol = \DB::table('role_user')
                ->where('user_id', '=', $id)
                ->where('role_id', '=', 3);
            $deleteRol->delete();
        }
        if ($level4 == false) {
            $deleteRol = \DB::table('role_user')
                ->where('user_id', '=', $id)
                ->where('role_id', '=', 4);
            $deleteRol->delete();
        }
        if ($level5 == false) {
            $deleteRol = \DB::table('role_user')
                ->where('user_id', '=', $id)
                ->where('role_id', '=', 5);
            $deleteRol->delete();
        }

        return $this->GestionRolesSearch()
            ->withErrors(['alerSuccesRol' => 'Los cambios fueron guardados exitosamente..!']);
    }

    public function GestionRolesSearch()
    {
        $variable = new Variables();
        $list_cargo = CargoUsuario::lists('nom_cargo', 'id');
        $list_secretaria = Secretaria::lists('nombre_secretaria', 'id');
        $list_municipio = Municipio::lists('nom_municipio', 'id');
        $nom_usuario = \Input::get('nom_usuario');
        $ape_usuario = \Input::get('ape_usuario');
        $num_identificacion = \Input::get('num_identificaion');
        $municipio = \Input::get('municipio');
        $munCondition = "users.id_municipio = $municipio";
        if ($municipio == 0) $munCondition = 'users.id_municipio';
        $secretaria = \Input::get('secretaria');
        $secCondition = "users.id_tipo_secretaria = $secretaria";
        if ($secretaria == 0) $secCondition = 'users.id_tipo_secretaria';
        $cargo = \Input::get('cargo');
        $cargoCondition = "users.id_cargo_usuario = $cargo";
        if ($cargo == 0) $cargoCondition = 'users.id_cargo_usuario';

        if (\Auth::user()->level() == 5)
        {
            $users = \DB::table('users')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->select('users.id', 'users.nom_usuario', 'users.ape_usuario',
                    'roles.level', 'users.num_identificacion')
                ->where('users.nom_usuario', 'LIKE', '%' . $nom_usuario . '%')
                ->where('users.ape_usuario', 'LIKE', '%' . $ape_usuario . '%')
                ->where('users.num_identificacion', 'LIKE', '%' . $num_identificacion . '%')
                ->where('users.estado_user', '=', $variable->UserRegistrado())
                ->whereNotIn('roles.level', array(1))
                ->whereNotIn('users.id', array(\Auth::user()->id))
                ->whereRaw($munCondition)
                ->whereRaw($secCondition)
                ->whereRaw($cargoCondition)
                ->groupBy('users.id')
                ->get();
        }

        if (\Auth::user()->level() == 4)
        {
            $users = \DB::table('users')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->select('users.id', 'users.nom_usuario', 'users.ape_usuario', 'users.num_identificacion')
                ->where('users.nom_usuario', 'LIKE', '%' . $nom_usuario . '%')
                ->where('users.ape_usuario', 'LIKE', '%' . $ape_usuario . '%')
                ->where('users.num_identificacion', 'LIKE', '%' . $num_identificacion . '%')
                ->where('users.estado_user', '=', $variable->UserRegistrado())
                ->whereNotIn('roles.level', array(3, 5))
                ->whereNotIn('users.id', array(\Auth::user()->id))
                ->whereRaw($munCondition)
                ->whereRaw($secCondition)
                ->whereRaw($cargoCondition)
                ->groupBy('users.id')
                ->get();
        }
        return view('template.Gestion_Usuarios.search')
            ->with('users', $users)
            ->with('list_cargo', $list_cargo)
            ->with('list_secretaria', $list_secretaria)
            ->with('list_municipio', $list_municipio);
    }

}


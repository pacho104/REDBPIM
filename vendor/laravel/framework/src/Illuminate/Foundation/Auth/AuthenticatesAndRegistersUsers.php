<?php namespace Illuminate\Foundation\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use App\Municipio;
use App\Secretaria;
use App\CargoUsuario;
use App\Variables;
use App\TipoIdentificacion;

use App\Http\Controllers\UserController;
use Illuminate\Routing\Router;

trait AuthenticatesAndRegistersUsers {


	/**
	 * The Guard implementation.
	 *
	 * @var \Illuminate\Contracts\Auth\Guard
	 */
	protected $auth;

	/**
	 * The registrar implementation.
	 *
	 * @var \Illuminate\Contracts\Auth\Registrar
	 */
	protected $registrar;

	/**
	 * Show the application registration form.aaa
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getRegister()
	{
        $list_municipio = Municipio::lists('nom_municipio', 'id');
        $list_secretaria = Secretaria::lists('nombre_secretaria', 'id');
        $list_cargo = CargoUsuario::lists('nom_cargo', 'id');
        $list_tipidentificacion = TipoIdentificacion::lists('nom_identificacion', 'id');

        $listroles = \DB::table('roles')->whereNotIn('id', array(4, 5))->lists('description', 'id');

       		return view('auth.register')

                    ->with('list_municipio', $list_municipio)
                    ->with('list_secretaria', $list_secretaria)
                    ->with('list_cargo', $list_cargo)
                    ->with('list_tipidentificacion', $list_tipidentificacion)
                    ->with('listroles', $listroles);
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postRegister(Request $request)
	{
		$validator = $this->registrar->validator($request->all());

		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator
			);
		}

		$this->registrar->create($request->all());
        $this->registrar->createRole($request->all());

		return  view('template.partials.modal_register');
	}

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
	public function getLogin()
	{
        $listroles = \DB::table('roles')->whereNotIn('id', array(4, 5))->lists('description', 'id');

		return view('auth.login')

        ->with('listroles', $listroles);
	}

    public function desktop (Request $request)
    {
        return 'a';

       $rol = $request->get('rol_usuario');

        if ($rol == 3)
        {
            return view('desktop_SecDepartamental');
        }
        if ($rol == 2)
        {
            return view('desktop_SecMunicipal');
        }
        if ($rol == 1)
        {
            return view('desktop_SecSectorial');
        }
    }


	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postLogin(Request $request)
    {

        $obtenerEstadoUser = new Variables();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'rol_usuario' => 'exists:roles,id',
        ]);

        $credentials = $request->only('email', 'password');

        if ($this->auth->attempt($credentials, $request->has('remember')))
        {
            $this->auth->logout();

            $getid = \DB::table('users')
                ->where('email', '=', $request->get('email'))
                ->first();

            $user_roles = \DB::table('role_user')
                ->where('user_id', '=', $getid->id)
                ->where('role_id', '=', $request->get('rol_usuario'))
                ->first();

            $getestado = \DB::table('users')
                ->where('id', '=', $getid->id)
                ->where('estado_user', '=' ,$obtenerEstadoUser->UserRegistrado())
                ->first();


            if(is_null($user_roles))
            {
                return redirect($this->loginPath())
                    ->withInput($request->except('password'))
                    ->with('alertRol','El rol seleccionado no se encuentra asignado a su usuario. Verifique esto.!');
            }
            if(is_null($getestado))
            {
                return view('template.partials.modal_login');
            }


            $rol = $request->get('rol_usuario');
            \Session::put('key', $rol);

            $this->auth->attempt($credentials, $request->has('remember'));
            return redirect()->intended($this->redirectPath());
        }

        return redirect($this->loginPath())
            ->withInput($request->except('password'))
            ->withErrors([
                'email' => $this->getFailedLoginMessage(),
            ]);
    }

	/**
	 * Get the failed login message.
	 * @return string
	 */
	protected function getFailedLoginMessage()
	{
		return 'usuario o contraseña inválidos.';
	}

	/**
	 * Log the user out of the application.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogout()
	{
		$this->auth->logout();

		return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
	}

	/**
	 * Get the post register / login redirect path.
	 *
	 * @return string
	 */
	public function redirectPath()
	{
		if (property_exists($this, 'redirectPath'))
		{
			return $this->redirectPath;
		}

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/desktop';
	}

	/**
	 * Get the path to the login route.
	 *
	 * @return string
	 */
	public function loginPath()
	{
		return property_exists($this, 'loginPath') ? $this->loginPath : '/auth/login';
	}

}

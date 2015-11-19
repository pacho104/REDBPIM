<?php namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use App\Municipio;
use App\Secretaria;
use App\CargoUsuario;
use App\TipoIdentificacion;


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

        $listroles = \DB::table('roles')->whereNotIn('id', array(1, 2))->lists('description', 'id');

        return view('auth.register')

            ->with('list_municipio', $list_municipio)
            ->with('list_secretaria', $list_secretaria)
            ->with('list_cargo', $list_cargo)
            ->with('list_tipidentificacion', $list_tipidentificacion);
            //->with('listroles', $listroles);
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

        return  view('template.modal');
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
       // $listroles = \DB::table('roles')->lists('description', 'id');

        return view('auth.login');

         //   ->with('listroles', $listroles);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if ($this->auth->attempt($credentials, $request->has('remember')))
        {
            return redirect()->intended($this->redirectPath());
        }

        return redirect($this->loginPath())
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => $this->getFailedLoginMessage(),
            ]);
    }

    /**
     * Get the failed login message.
     *
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

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/admin';
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
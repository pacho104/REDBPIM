<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\RegistroEnvio;
use Illuminate\Http\Request;
use Mail;

class RegistroEnvioController extends Controller {


    /**
     * Método contructor que determina que las funciones de la clase FormatoEmailController las
     * puede usar un usuario autenticado en el sistema utilizando el middelware auth.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function index($fecha,$idFormato_email)
    {
        /** @var TYPE_NAME $request */

        $regEnvi = RegistroEnvio::filtroAndPaginacion($fecha,$idFormato_email);
        return $regEnvi;

    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public static function crearRegEnvEmail($idFormato,$user,$dias_vigencia){


        $registroEnv = new RegistroEnvio();

        $registroEnv->id_formato_email  = $idFormato;
        $registroEnv->save();




        $registroEnv = RegistroEnvio::filtro($registroEnv->id_formato_email);



        $emailDestino  =   $registroEnv->toArray()[0]['formato_email']['email_destino'];
        $cuerpo        =   $registroEnv->toArray()[0]['formato_email']['cuerpo'];
        $asunto        =   $registroEnv->toArray()[0]['formato_email']['asunto'];
        $nombreFormato =   $registroEnv->toArray()[0]['formato_email']['nom_formato'];


        RegistroEnvioController::enviarEmail($emailDestino,$cuerpo,$asunto,$nombreFormato,$user,$dias_vigencia);

        return $registroEnv;
    }

    public static function enviarEmail($emailDestino,$cuerpo,$asunto,$nombreFormato,$user,$dias_vigencia){




        $nombreUsuario  = $user->toArray()[0]['nom_usuario'].' '.$user->toArray()[0]['ape_usuario'];
        $emailRespuesta = $user->toArray()[0]['email'];
        $secretaria     = $user->toArray()[0]['secretaria']['nombre_secretaria'];
        $cargo          = $user->toArray()[0]['cargo']['nom_cargo'];




        $data = array
        (
            'name'		 =>	$nombreUsuario,
            'subject'	 =>	$asunto,
            'msg'		 =>	$cuerpo,
            'emailRes'   => $emailRespuesta,
            'nomFormato' => $nombreFormato,
            'cargo'      => $cargo,
            'secretaria' => $secretaria,
            'vigencia'   => $dias_vigencia
        );


        Mail::later(15,'template.Emails.email', $data, function($message)use($emailDestino,$asunto)
        {
            $message->to($emailDestino)
            ->subject($asunto);
        });

        return ;
    }
}

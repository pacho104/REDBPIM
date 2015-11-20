<?php namespace App\Http\Controllers;

use App\FormatoEmail;
use App\Http\Requests;
use App\User;
use Auth;
use Illuminate\Http\Request;

class FormatoEmailController extends Controller {


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
     * @param $id
     * @return Response
     */
    public function index($id)
	{
        /** @var TYPE_NAME $request */

        $formatoEBan = FormatoEmail::filtroAndPaginacion($id);
        return $formatoEBan;

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
     * @return Response
     */
	public function store()
	{


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
        $formatoEmailBan = FormatoEmail::find($id);
        $formatoEmailBan->delete();
        return;
	}


    /**
     *
     * @param $nom_formato1
     * @param $asunto1
     * @param $cuerpo1
     * @param $email_origen1
     * @param $email_destino1
     * @return Response
     * @internal param $nom_formato_solicitud1
     * @internal param $cuerpo_formato_solicitud1
     */
    public static function crearFmtEmail($nom_formato1,$asunto1,$cuerpo1,$email_origen1,$email_destino1)
    {

        $formatoEmailBan = new FormatoEmail();


        $formatoEmailBan->nom_formato   = $nom_formato1;
        $formatoEmailBan->asunto        = $asunto1;
        $formatoEmailBan->cuerpo        = $cuerpo1;
        $formatoEmailBan->email_origen  = $email_origen1;
        $formatoEmailBan->email_destino = $email_destino1;
        $formatoEmailBan->save();

        return $formatoEmailBan;


    }
}

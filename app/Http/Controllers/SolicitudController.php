<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Solicitud;
use App\TiempoSolicitud;
use App\User;
use Auth;
use Illuminate\Http\Request;

class SolicitudController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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


    /**
     * Crea una solicitud con los requisitos enviados por parametro
     * @param $nom_solicitud1
     * @param $asunto
     * @param $cuerpo
     * @param $email_origen
     * @param $email_destino
     * @return Solicitud
     */
    public static function crearSolicitud($nom_solicitud1,$asunto,$cuerpo,$email_origen,$email_destino)
    {
        $idUser = Auth::user()->id;
        $user   = User::filtro($idUser);
        $id_mun = $user->toArray()['0']['id_municipio'];



        $formatoEmail     = FormatoEmailController::crearFmtEmail($nom_solicitud1,$asunto,$cuerpo,$email_origen,$email_destino);
        $formatoSolicitud = FormatoSolicitudController::crearFmtSol($nom_solicitud1,$cuerpo,$id_mun);
        $tiempoSolicitud  = TiempoSolicitud::filtro($nom_solicitud1,$id_mun);


        $diasVigencia     = $tiempoSolicitud->toArray()[0]['tiempo'];



        $solicitudBan = new Solicitud();


        $solicitudBan->nom_solicitud         = $nom_solicitud1;
        $solicitudBan->num_solicitud         = SolicitudController::utl($id_mun);
        $solicitudBan->dias_vigencia         = $diasVigencia;
        $solicitudBan->id_formato_solicitud  = $formatoSolicitud->toArray()['id'];
        $solicitudBan->id_formato_email      = $formatoEmail->toArray()['id'];
        $solicitudBan->id_usuario            = $idUser;
        $solicitudBan->id_municipio          = $id_mun;
        $solicitudBan->save();


        RegistroEnvioController::crearRegEnvEmail($formatoEmail->toArray()['id'],$user,$diasVigencia);



        return $solicitudBan;


    }

    /**
     * Trae el cosecutivo de las solicitudes creadas
     * @return int
     */
    public static function utl($idMun)
    {


        $ultimaSolicitud     = Solicitud::ultimoRegSolicitud($idMun);




        if($ultimaSolicitud == null)
        {
            $cosecutivoForSoli = 1;

        }
        else
        {
            $cosecutivoForSoli  = $ultimaSolicitud->toArray()['num_solicitud'];
            $cosecutivoForSoli +=1;
        }

        return $cosecutivoForSoli;

    }
}

<?php namespace App\Http\Controllers;

use App\FormatoSolicitud;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Solicitud;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FormatoSolicitudController extends Controller {

    /**
     * Método contructor que determina que las funciones de la clase FormatoSolicitud las
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



        $formatoSBan = FormatoSolicitud::filtroAndPaginacion($id);
        return $formatoSBan;

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
     * @param $nom_formato_solicitud1
     * @param $cuerpo_formato_solicitud1
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
        $formatoSolBan = FormatoSolicitud::find($id);
        $formatoSolBan->delete();
        return;
    }

    /**
     * retorna el ultimo consecutivo que se registro en el formato de la solicitud
     * @return FormatoSolicitud
     */
    public function utl()
    {

        $idUser              = Auth::user()->id;
        $user                = User::filtro($idUser);
        $id_mun              = $user->toArray()['0']['id_municipio'];
        $ultimaSolicitud     = Solicitud::ultimoReg($id_mun);



        if($ultimaSolicitud == null)
        {
            $cosecutivoForSoli = 1;
        }
        else
        {
            $cosecutivoForSoli  = $ultimaSolicitud->toArray()['formato_solicitud']['consecutivo_formato_solicitud'];
            $cosecutivoForSoli +=1;
        }

        return $cosecutivoForSoli;

    }

    /**
     *
     * @param $nom_formato_solicitud1
     * @param $cuerpo_formato_solicitud1
     * @return Response
     */
    public static function crearFmtSol($nom_formato_solicitud1,$cuerpo_formato_solicitud1)
    {

        $formatoSoliBan = new FormatoSolicitud();


        $formatoSoliBan->nom_formato_solicitud           = $nom_formato_solicitud1;
        $formatoSoliBan->cuerpo_formato_solicitud        = $cuerpo_formato_solicitud1;
        $formatoSoliBan->consecutivo_formato_solicitud   = FormatoSolicitudController::utl();
        $formatoSoliBan->save();

        return $formatoSoliBan;

    }

}

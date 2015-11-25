<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\TiempoSolicitudRequest;
use App\Solicitud;
use App\TiempoSolicitud;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Redirect;

class TiempoSolicitudController extends Controller {


    /**
     * Método contructor que determina que las funciones de la clase TiempoSolicitudController las
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
	public function index(Request $request)
	{

        $idUser = Auth::user()->id;
        $user   = User::filtro($idUser);
        $id_mun = $user->toArray()['0']['id_municipio'];


        /** @var TYPE_NAME $request  */
        $tiempoSolicitudBan = TiempoSolicitud::filtroAndPaginacion($request->get('nom_solicitud'),$id_mun);

        return view('template.Update_tiempoSolicitud.tiempoSolicitud',compact('tiempoSolicitudBan'));
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
     * @param TiempoSolicitudRequest $request
     * @param  int $id
     * @return Response
     */
	public function update(TiempoSolicitudRequest $request, $id)
	{
        $tiempoSolicitudBan = TiempoSolicitud::findOrFail($id);



        $tiempoSolicitudBan->fill($request->all());
        $tiempoSolicitudBan->tiempo = $request->get('tiempo');
        $tiempoSolicitudBan->save();

        return Redirect::route('tiempoSolicitud.index')
            ->with('alert', 'Registro Actualizado con exito!');
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

}

<?php namespace App\Http\Controllers;


use App\Http\Controllers\Controller;

use App\Http\Requests\ExistSalaRequest;
use App\Mensaje;
use App\MensajeSala;
use App\SalasChat;
use Auth;
use DateTime;
use Illuminate\Http\Request;


class MensajeController extends Controller {


    public function __construct()
    {
        $this->middleware('auth');

    }

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
     * @param Request $request
     * @return Response
     * @internal param int $id
     */
	public function destroy(Request $request)
	{

            Mensaje::destroy($request->input('che'));

            return redirect()->back()->with('message', 'Registro Seleccionado Fue Eliminado');

	}


    /**
     * Registra un nuevo mensaje en la base de datos
     * @param $idSala
     * @param Request $request
     * @param ExistSalaRequest $existSalaRequest
     * @return \Illuminate\View\View ---el mensaje la hora y la fecha en la que se envio
     */
    public function crearMensaje($idSala,Request $request){


        $mensaje = new Mensaje();
        $horaFecha= new DateTime();


        $mensaje->texto_mensaje = $request->get('message');
        $mensaje->hora_mensaje=$horaFecha;
        $mensaje->fecha_mensaje=$horaFecha;
        $mensaje->id_sala_chat= $idSala;
        $mensaje->id_usuario= Auth::user()->id;
        $mensaje->save();

    }


}

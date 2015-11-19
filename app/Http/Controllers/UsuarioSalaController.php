<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\SalasChatUsuariosRequest;
use App\Mensaje;
use App\SalasChat;
use App\UsuariosSala;
use Auth;
use Illuminate\Http\Request;
use Redirect;
use View;

class UsuarioSalaController extends Controller {

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
     * @param int $id
     * @return usuario Registrado en Sala
     */
    public function registrarUsuarioSala($idSala)
    {
        $idUsu=Auth::user()->id;


        //verificar si ya existe un registro del usuario en la sala seleccionada
        $validador= UsuariosSala::verificar($idSala,$idUsu);


        //traer los usuarios que enviaron los mensajes a una sala
         $mensajes=SalasChat::usuariosMensajes($idSala);



        if($validador==1){


            $usu_sala=SalasChat::usuariosRegSala($idSala);

            return View::make('template.chat.index',compact('usu_sala','idSala','mensajes'));

        }
        else {

            $usuario_sala = new UsuariosSala;
            $usuario_sala->id_sala_chat = $idSala;
            $usuario_sala->id_usuario = $idUsu;
            $usuario_sala->save();

            $usu_sala=SalasChat::usuariosRegSala($idSala);

            return View::make('template.chat.index',compact('usu_sala','idSala','mensajes'));
        }



    }

    /**
     * Trae todos los usuarios con los mensajes que enviaron a una sala de chat
     * @param $idSala identificador de la sala que se quiere consultar
     */
    public function mjsUsuarioSala($idSala){

        //traer los usuarios que enviaron los mensajes a una sala

        $mensajes=SalasChat::usuariosMensajes($idSala);

        return View::make('template.chat.mjs_sala',compact('idSala','mensajes'));

    }
}

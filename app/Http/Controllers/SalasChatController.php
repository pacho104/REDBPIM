<?php namespace App\Http\Controllers;

use App\AdministradorSala;
use App\AdministradorSalas;
use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Http\Requests\SalasChatRequest;
use App\Mensaje;
use App\SalasChat;
use App\User;
use App\UsuariosSala;
use Auth;
use Illuminate\Http\Request;
use Input;
use Redirect;

class SalasChatController extends Controller {


    /**
     * Método contructor que determina que las funciones de la clase SalasController las
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
        $idUser= Auth::user()->id;
        $sala_chat = SalasChat::filtroAndPaginacion($idUser,$request->get('nom_sal'));
        return view('template.chat.salas_chat',compact('sala_chat'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('template.chat.new_sala_chat');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(SalasChatRequest $request)
	{

        $sala_chat = new SalasChat;

        $sala_chat->fill($request->all());
        $sala_chat->nombre_sala_chat = \Input::get('nombre_sala');
        $sala_chat->usuario_id_usuario= Auth::user()->id;
        $sala_chat->save();

        return Redirect::route('salas.index')
            ->with('alert', 'Registro creado con exito!');

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
        $sala_chat = SalasChat::findOrFail($id);
        return view('template.chat.edit_sala_chat', compact('sala_chat'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(SalasChatRequest $request,$id)
	{
        $sala_chat = SalasChat::findOrFail($id);

        $sala_chat->fill($request->all());
        $sala_chat->nombre_sala_chat = \Input::get('nombre_sala');
        $sala_chat->save();

        return redirect()->back();
	}

     /**
     * @param int $id
     * @return Valores Actualizados
     */
    public function cambiarEstado($id)
    {
        SalasChat::cambiarDeEstado($id);
        return redirect()->back();
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

        Mensaje::where('id_sala_chat',$id)->delete();
        UsuariosSala::where('id_sala_chat',$id)->delete();
        $sala = SalasChat::find($id);
        $sala->delete();

       return redirect()->back()->with('ValidationDelete', 'Registro Seleccionado Fue Eliminado');


	}
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function salasOn(Request $request)
    {
        $estado=1;
        $sala_chat = SalasChat::salasDisponibles($estado,$request->get('nom_sal'));
        return view('template.chat.salas_chat_on',compact('sala_chat'));
    }

}

<?php namespace App\Http\Controllers;

use App\Estado;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\EstadoRequest;
use Illuminate\Http\Request;
use Redirect;

class EstadoController extends Controller {


    /**
     * Método contructor que determina que las funciones de la clase EstadoController las
     * puede usar un usuario autenticado en el sistema utilizando el middelware auth.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
	public function index(Request $request)	{

        $estadoBan = Estado::filtroAndPaginacion($request->get('nom_estado'));
        return view('template.CRUD_estado.estado',compact('estadoBan'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('template.CRUD_estado.new_estado');
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param EstadoRequest $request
     * @return Response
     */
	public function store(EstadoRequest $request)
	{
        $estadoBan = new Estado();

        $estadoBan->fill($request->all());
        $estadoBan->nom_estado = $request->get('nombre_estado');
        $estadoBan->save();

        return Redirect::route('estados.index')
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
		$estadoBan =  Estado::findOrFail($id);
        return view('template.CRUD_estado.edit_estado',compact('estadoBan'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param EstadoRequest $request
     * @param  int $id
     * @return Response
     */
	public function update(EstadoRequest $request,$id)
	{

            $estadoBan = Estado::findOrFail($id);


            $estadoBan->fill($request->all());
            $estadoBan->nom_estado = $request->get('nombre_estado');
            $estadoBan->save();

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
        $estadoBan = Estado::find($id);
        $estadoBan->delete();

        return redirect()->back()->with('ValidationDelete', 'Registro Seleccionado Fue Eliminado');
	}

}

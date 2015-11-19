<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ProcesoRequest;
use App\Proceso;
use Illuminate\Http\Request;
use PDOException;
use Redirect;

class ProcesoController extends Controller {


    /**
     * Método contructor que determina que las funciones de la clase ProcesoController las
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
	public function index(Request $request)
	{
        /** @var TYPE_NAME $request */
        $procesoBan = Proceso::filtroAndPaginacion($request->get('nom_proceso'));
        return view('template.CRUD_proceso.proceso',compact('procesoBan'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('template.CRUD_proceso.new_proceso');
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param ProcesoRequest $request
     * @return Response
     */
	public function store(ProcesoRequest $request)
	{
        $procesoBan = new Proceso();

        $procesoBan->fill($request->all());
        $procesoBan->nom_proceso = $request->get('nombre_proceso');
        $procesoBan->save();

        return Redirect::route('proceso.index')
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
        $procesoBan =  Proceso::findOrFail($id);
        return view('template.CRUD_proceso.edit_proceso',compact('procesoBan'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(ProcesoRequest $request, $id)
	{
        $procesoBan = Proceso::findOrFail($id);


        $procesoBan->fill($request->all());
        $procesoBan->nom_proceso = $request->get('nombre_proceso');
        $procesoBan->save();

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
        try {
            $procesoBan = Proceso::find($id);
            $procesoBan->delete();
        } catch (PDOException $e) {

            return redirect()->back()->with('ValidationDelete', 'Registro Seleccionado No Fue Eliminado Porqué Esta en Uso');
        }

        return redirect()->back()->with('ValidationDelete', 'Registro Seleccionado Fue Eliminado');
	}

}

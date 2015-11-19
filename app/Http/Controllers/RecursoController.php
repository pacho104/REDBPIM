<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\RecursoRequest;
use App\Recurso;
use Illuminate\Http\Request;
use PDOException;
use Redirect;

class RecursoController extends Controller {


    /**
     * Método contructor que determina que las funciones de la clase RecursoController las
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
        /** @var TYPE_NAME $request */
        $recursoBan = Recurso::filtroAndPaginacion($request->get('nom_recurso'));
        return view('template.CRUD_recurso.recurso',compact('recursoBan'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('template.CRUD_recurso.new_recurso');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(RecursoRequest $request)
	{
        $recursoBan = new Recurso();

        $recursoBan->fill($request->all());
        $recursoBan->nom_recurso = $request->get('nombre_recurso');
        $recursoBan->save();

        return Redirect::route('recurso.index')
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
        $recursoBan =  Recurso::findOrFail($id);
        return view('template.CRUD_recurso.edit_recurso',compact('recursoBan'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param RecursoRequest $request
     * @param  int $id
     * @return Response
     */
	public function update(RecursoRequest $request, $id)
	{
        $recursoBan = Recurso::findOrFail($id);


        $recursoBan->fill($request->all());
        $recursoBan->nom_recurso = $request->get('nombre_recurso');
        $recursoBan->save();

        return Redirect::route('recurso.index')
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

        try {
            $recursoBan = Recurso::find($id);
            $recursoBan->delete();
        } catch (PDOException $e) {

            return redirect()->back()->with('ValidationDelete', 'Registro Seleccionado No Fue Eliminado Porqué Esta en Uso');
        }

        return redirect()->back()->with('ValidationDelete', 'Registro Seleccionado Fue Eliminado');
	}

}

<?php namespace App\Http\Controllers;

use App\EtapaLista;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\EtapaListaRequest;
use App\Recurso;
use Illuminate\Http\Request;
use PDOException;
use Redirect;

class EtapaListaController extends Controller {

    /**
     * Método contructor que determina que las funciones de la clase EtapaListaController las
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
         $etapaListaBan = EtapaLista::filtroAndPaginacion($request->get('nom_etapa'));
         return view('template.CRUD_etapaLista.etapaLista',compact('etapaListaBan'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $list_recu = Recurso::lists('nom_recurso', 'id');
        return view('template.CRUD_etapaLista.new_etapaLista',compact('list_recu'));

	}

    /**
     * Store a newly created resource in storage.
     *
     * @param EtapaListaRequest $request
     * @return Response
     */
	public function store(EtapaListaRequest $request)
	{
        try {
                $etapaListaBan = new EtapaLista();

                $etapaListaBan->fill($request->all());
                $etapaListaBan->nom_etapa = $request->get('nombre_etapaLista');
                $etapaListaBan->recurso_id_recurso = $request->get('recurso');
                $etapaListaBan->save();

        } catch (PDOException $e) {

            return redirect()->back()->with('ValidationDelete', 'Ya Existe Un Registro Igual');
        }

        return Redirect::route('etapaLista.index')
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
        $list_recu = Recurso::lists('nom_recurso', 'id');
        $etapaListaBan =  EtapaLista::findOrFail($id);
        return view('template.CRUD_etapaLista.edit_etapaLista',compact('list_recu','etapaListaBan'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EtapaListaRequest $request,$id)
	{

        try {
            $etapaListaBan = EtapaLista::findOrFail($id);

            $etapaListaBan->fill($request->all());
            $etapaListaBan->nom_etapa = $request->get('nombre_etapaLista');
            $etapaListaBan->recurso_id_recurso = $request->get('recurso');
            $etapaListaBan->save();

        } catch (PDOException $e) {

            return redirect()->back()->with('ValidationDelete', 'Ya Existe Un Registro Igual');
        }


        return Redirect::route('etapaLista.index')
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
            $etapaListaBan = EtapaLista::find($id);
            $etapaListaBan->delete();
        } catch (PDOException $e) {

            return redirect()->back()->with('ValidationDelete', 'Registro Seleccionado No Fue Eliminado Porqué Esta en Uso');
        }

        return redirect()->back()->with('ValidationDelete', 'Registro Seleccionado Fue Eliminado');
	}

}

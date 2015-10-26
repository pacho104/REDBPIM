<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\RequisitoRequest;
use App\Municipio;
use App\Requisito;
use App\User;
use Auth;
use Illuminate\Http\Request;
use INPUT;
use PDOException;
use Redirect;

class RequisitoController extends Controller {


    /**
     * Método contructor que determina que las funciones de la clase RequisitoController las
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

        /** @var TYPE_NAME $request */
        $requisitoBan = Requisito::filtroAndPaginacion($request->get('nom_requisito'));
        return view('template.CRUD_requisito.requisito',compact('requisitoBan'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('template.CRUD_requisito.new_requisito');
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param RequisitoRequest $request
     * @return Response
     */
    public function store(RequisitoRequest $request)
    {
        $obli = \Input::get('cheObli');

        if($obli=='on'){$obli=1;}else{$obli=0;}

        $requisitoBan = new Requisito();

        $requisitoBan->fill($request->all());
        $requisitoBan->nom_requisito = $request->get('nombre_requisito');
        $requisitoBan->obligatorio = $obli;
        $requisitoBan->save();

        return Redirect::route('requisito.index')
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
        $requisitoBan =  Requisito::findOrFail($id);
        return view('template.CRUD_requisito.edit_requisito',compact('requisitoBan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RequisitoRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(RequisitoRequest $request,$id)
    {
        $obli = \Input::get('cheObli');

        if($obli=='on'){$obli=1;}else{$obli=0;}


        $requisitoBan = Requisito::findOrFail($id);

        $idMun=$requisitoBan->municipio_id_municipio;


        $requisitoBan->fill($request->all());
        $requisitoBan->nom_requisito = $request->get('nombre_requisito');
        $requisitoBan->obligatorio = $obli;
        $requisitoBan->save();

        if($idMun==null){
            return Redirect::route('requisito.index')
                ->with('alert', 'Registro Actualizado con exito!');
        }
        else{
            return Redirect::route('reqM')
                ->with('alert', 'Registro Actualizado con exito!');
        }



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
                $requisitoBan = Requisito::find($id);
                $requisitoBan->delete();
        } catch (PDOException $e) {

            return redirect()->back()->with('ValidationDelete', 'Registro Seleccionado No Fue Eliminado Porqué Se Usa En Una Lista');
        }

        return redirect()->back()->with('ValidationDelete', 'Registro Seleccionado Fue Eliminado');
	}

    ///requisitos para el municipio

    /**
     * Trae todos los requisitos que estan registrados en un municipio
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function indexReqMun(Request $request)	{

        $idUser = Auth::user()->id;
        $user  = User::filtro($idUser);
        $idMun=$user->toArray()[0]['municipio']['id'];


        /** @var TYPE_NAME $request */
        $requisitoBan = Requisito::filtroAndPaginacionMun($request->get('nom_requisito'),$idMun);
        return view('template.CRUD_requisitoMun.requisitoMun',compact('requisitoBan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function createReqMun()
    {

        return view('template.CRUD_requisitoMun.new_requisitoMun');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RequisitoRequest $request
     * @return Response
     */
    public function storeReqMun(RequisitoRequest $request)
    {
        $idUser = Auth::user()->id;
        $user  = User::filtro($idUser);
        $idMun=$user->toArray()[0]['municipio']['id'];

        $obli = \Input::get('cheObli');

        if($obli=='on'){$obli=1;}else{$obli=0;}


                $requisitoBan = new Requisito();

                $requisitoBan->fill($request->all());
                $requisitoBan->nom_requisito = $request->get('nombre_requisito');
                $requisitoBan->obligatorio = $obli;
                $requisitoBan->municipio_id_municipio = $idMun;
                $requisitoBan->save();

        return Redirect::route('reqM')
            ->with('alert', 'Registro creado con exito!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editReqMun($id)
    {
        $requisitoBan =  Requisito::findOrFail($id);
        return view('template.CRUD_requisitoMun.edit_requisitoMun',compact('requisitoBan'));
    }

}

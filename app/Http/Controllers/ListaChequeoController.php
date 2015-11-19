<?php namespace App\Http\Controllers;

use App\EtapaLista;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ListaChequeoRequest;
use App\ListaChequeo;
use App\Proceso;
use App\Requisito;
use App\SectorInversion;
use App\Tipo;
use App\User;
use Auth;
use Illuminate\Http\Request;
use PDOException;
use Redirect;

class ListaChequeoController extends Controller {


    /**
     * Método contructor que determina que las funciones de la clase ListaChequeoController las
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

        $listaBan = ListaChequeo::filtroAndPaginacion($request->get('nom_lista'));
        return view('template.CRUD_listaChequeo.lista',compact('listaBan'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

        $sector  = SectorInversion::lists('nom_sector_inversion','id');
        $etapa   = EtapaLista::lists('nom_etapa','id');
        $proceso = Proceso::lists('nom_proceso','id');
        $tipo    = Tipo::lists('nom_tipo','id');

        return view('template.CRUD_listaChequeo.new_lista',compact('sector','etapa','proceso','tipo'));
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param ListaChequeoRequest $request
     * @return Response
     */
    public function store(ListaChequeoRequest $request)
    {


            $listaBan = new ListaChequeo();
            $listaBan->fill($request->all());
            $listaBan->nom_lista = $request->get('nombre_lista');
            $listaBan->tipo_lista = $request->get('tipo');
            $listaBan->sector_inversion_id_sector = $request->get('sector');
            $listaBan->etapa_lista_id_etapa = $request->get('etapa');
            $listaBan->proceso_id_proceso = $request->get('proceso');
            $listaBan->save();

            return Redirect::route('lista.index')
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
        $sector   = SectorInversion::lists('nom_sector_inversion', 'id');
        $etapa    = EtapaLista::lists('nom_etapa', 'id');
        $proceso  = Proceso::lists('nom_proceso', 'id');
        $listaBan =  ListaChequeo::findOrFail($id);
        $tipo     = Tipo::lists('nom_tipo','id');

        return view('template.CRUD_listaChequeo.edit_lista',compact('listaBan','sector','etapa','proceso','tipo'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param ListaChequeoRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(ListaChequeoRequest $request,$id)
    {

            $listaBan = ListaChequeo::findOrFail($id);

            $idMun=$listaBan->municipio_id_municipio;


            $listaBan->fill($request->all());
            $listaBan->nom_lista = $request->get('nombre_lista');
            $listaBan->tipo_lista =$request->get('tipo');
            $listaBan->sector_inversion_id_sector = $request->get('sector');
            $listaBan->etapa_lista_id_etapa = $request->get('etapa');
            $listaBan->proceso_id_proceso = $request->get('proceso');
            $listaBan->save();




        if($idMun==null){
            return Redirect::route('lista.index')
                ->with('alert', 'Registro Actualizado con exito!');
        }
        else{
            return Redirect::route('lisM')
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
        $listaBan = ListaChequeo::find($id);
        $listaBan->delete();

        return redirect()->back()->with('ValidationDelete', 'Registro Seleccionado Fue Eliminado');
	}

    /**
     * registra los requisitos para la lista
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registrarReq(Request $request){

        $ids=$request->input('che1');

        for($i=0;$i<count($ids);$i++){

            try {
                $listaBan=ListaChequeo::find($request->input('idLi'));
                $listaBan->requisitos()->attach($ids[$i]);
            } catch (PDOException $e) {

                return redirect()->back();
            }
        }

        return redirect()->back();

    }

    /**
     *Lista los requisitos que tiene una lista
     *
     * @param RequisitosLista
     * @param $idLista
     * @return \Illuminate\View\View
     */
    public function requisitoLista($idLista){


        $requisitoBan    =  Requisito::traerReq(\Input::get('nom_requisito1'));
        $nomReq          =  \Input::get('nom_requisito2');
        $requisitoLista  =   ListaChequeo::reqLista($idLista,$nomReq);


        return view('template.CRUD_listaChequeo.requisitos',compact('requisitoBan','requisitoLista','idLista'));

    }
    /**
     *Lista los requisitos que tiene una lista de un municipio
     *
     * @param RequisitosLista
     * @param $idLista
     * @return \Illuminate\View\View
     */
    public function requisitoListaMun($idLista){

        $idUser = Auth::user()->id;
        $user   = User::filtro($idUser);
        $idMun  = $user->toArray()[0]['municipio']['id'];

        $requisitoBan   =  Requisito::traerReqMun(\Input::get('nom_requisito1'),$idMun);
        $nomReq         =  \Input::get('nom_requisito2');
        $requisitoLista =  ListaChequeo::reqLista($idLista,$nomReq);


        return view('template.CRUD_listaChequeoMun.requisitosMun',compact('requisitoBan','requisitoLista','idLista'));

    }

    /**
     * elimina todos los requisitos que estan en el array
     * @param Request $request
     * @param $idLista
     * @return \Illuminate\Http\RedirectResponse
     */
    public function eliminarReq(Request $request,$idLista){


        if($request->input('che2')!=null)
        {

        $listaBan=ListaChequeo::find($idLista);
        $ver= $listaBan->requisitos()->detach($request->input('che2'));

            if($ver>=1)
            {
                return redirect()->back()->with('message', 'Registro Seleccionado Fue Eliminado');
            }else {

                return redirect()->back();

            }
        }else{

            return redirect()->back();
        }


    }

    //Lista de chequeo para los municipios

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function indexLiMun(Request $request){

        $idUser = Auth::user()->id;
        $user  = User::filtro($idUser);
        $idMun=$user->toArray()[0]['municipio']['id'];

        $listaBan = ListaChequeo::filtroAndPaginacionMun($request->get('nom_lista'),$idMun);
        return view('template.CRUD_listaChequeoMun.listaMun',compact('listaBan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function createLiMun()
    {

        $sector  = SectorInversion::lists('nom_sector_inversion','id');
        $etapa   = EtapaLista::lists('nom_etapa','id');
        $proceso = Proceso::lists('nom_proceso','id');
        $tipo    = Tipo::lists('nom_tipo','id');

        return view('template.CRUD_listaChequeoMun.new_listaMun',compact('sector','etapa','proceso','tipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ListaChequeoRequest $request
     * @return Response
     */
    public function storeLiMun(ListaChequeoRequest $request)
    {

        $idUser = Auth::user()->id;
        $user  = User::filtro($idUser);
        $idMun=$user->toArray()[0]['municipio']['id'];

        $listaBan = new ListaChequeo();
        $listaBan->fill($request->all());
        $listaBan->nom_lista = $request->get('nombre_lista');
        $listaBan->tipo_lista = $request->get('tipo');
        $listaBan->sector_inversion_id_sector = $request->get('sector');
        $listaBan->etapa_lista_id_etapa = $request->get('etapa');
        $listaBan->proceso_id_proceso = $request->get('proceso');
        $listaBan->municipio_id_municipio = $idMun;
        $listaBan->save();

        return Redirect::route('lisM')
            ->with('alert', 'Registro creado con exito!');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editLiMun($id)
    {
        $sector   = SectorInversion::lists('nom_sector_inversion', 'id');
        $etapa    = EtapaLista::lists('nom_etapa', 'id');
        $proceso  = Proceso::lists('nom_proceso', 'id');
        $listaBan =  ListaChequeo::findOrFail($id);
        $tipo     = Tipo::lists('nom_tipo','id');

        return view('template.CRUD_listaChequeoMun.edit_listaMun',compact('listaBan','sector','etapa','proceso','tipo'));
    }

}

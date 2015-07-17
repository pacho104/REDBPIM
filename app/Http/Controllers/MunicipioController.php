<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Departamento;
use App\Municipio;
use Illuminate\Http\Request;

class MunicipioController extends Controller {

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
        $municipio = \DB::table('municipio')
            ->join('departamento', 'municipio.id_departamento', '=', 'departamento.id')
            ->select('municipio.*', 'departamento.nom_departamento')
            ->orderBy('municipio.id', 'asc')->paginate(10);

        return view('template.CRUD_municipio.municipio')
            ->with('municipio', $municipio);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $list_dep = Departamento::lists('nom_departamento', 'id');
        return view('template.CRUD_municipio.new_municipio')
            ->with('list_dep',$list_dep);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $data = \Request::all();
        $rules = array(
            'codigo_dane_municipio' => 'required|max:11|unique:municipio,cod_dane_mun',
            'nombre_municipio' => 'required|max:255|unique:municipio,nom_municipio',
            'departamento' => 'exists:departamento,id',
        );
        $error = \Validator::make($data,$rules);

        if($error->fails())
        {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

        $p = new Municipio;
        $p->cod_dane_mun = \Input::get('codigo_dane_municipio');
        $p->nom_municipio = \Input::get('nombre_municipio');
        $p->id_departamento = \Input::get('departamento');
        $p ->save();

        return \Redirect::route('municipio')
            ->with('alert' , 'Registro creado con exito!');
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
        $mun = Municipio::find($id);

        $list_dep = Departamento::lists('nom_departamento', 'id');
        $list_mun = Municipio::lists('nom_municipio', 'id');

        return view('template.CRUD_municipio.edit_municipio')
            ->with('mun', $mun)
            ->with('list_dep', $list_dep)
            ->with('list_mun', $list_mun);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $data = \Request::all();
        $rules = array(
            'codigo_dane_municipio' => "required|max:11|unique:municipio,cod_dane_mun,$id",
            'nombre_municipio' => "required|max:255|unique:municipio,nom_municipio,$id",
            'departamento' => 'exists:departamento,id',
        );
        $error = \Validator::make($data,$rules);

        if($error->fails())
        {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

        $p = Municipio::find($id);

        $p->cod_dane_mun = \Input::get('codigo_dane_municipio');
        $p->nom_municipio = \Input::get('nombre_municipio');
        $p->id_departamento = \Input::get('departamento');
        $p ->save();

        return \Redirect::route('municipio')
            ->with('alert', 'Actualización realizada exitosamente!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $data = \Request::all();
        $rules = array(
            $id => 'max:1',
        );
        $error = \Validator::make($data,$rules);

        if($error->fails())
        {
            return \Redirect::route('municipio')
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }
        $post = Municipio::find($id)->delete();

        return \Redirect::route('municipio')
            ->with('alert', 'Registro eliminado con exito!');
	}

}

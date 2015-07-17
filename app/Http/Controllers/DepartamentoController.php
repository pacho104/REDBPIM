<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Departamento;
use App\Municipio;

use Illuminate\Http\Request;

class DepartamentoController extends Controller {

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
        $departamento = Departamento::all();
        return view('template.CRUD_departamento.departamento')
            ->with('departamento', $departamento);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('template.CRUD_departamento.new_departamento');
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
            'codigo_dane_departamento' => 'required|max:11|unique:departamento,cod_dane_dep',
            'nombre_departamento' => 'required|max:100|string|unique:departamento,nom_departamento',
        );

        $error = \Validator::make($data,$rules);

        if($error->fails())
        {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

        $p = new Departamento;
        $p->cod_dane_dep = \Input::get('codigo_dane_departamento');
        $p->nom_departamento = \Input::get('nombre_departamento');
        $p ->save();

        return \Redirect::route('departamento')
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
        $dep = Departamento::find($id);
        return view('template.CRUD_departamento.edit_departamento')
            ->with('dep', $dep);
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
            'codigo_dane_departamento' => "required|max:11|unique:departamento,cod_dane_dep,$id",
            'nombre_departamento' => "required|max:255|unique:departamento,nom_departamento,$id",
        );
        $error = \Validator::make($data,$rules);

        if($error->fails())
        {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

        $p = Departamento::find($id);
        $p->cod_dane_dep = \Input::get('codigo_dane_departamento');
        $p->nom_departamento = \Input::get('nombre_departamento');
        $p ->save();

        return \Redirect::route('departamento')
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
            return \Redirect::route('departamento')
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }
        $post = Departamento::find($id)->delete();

        return \Redirect::route('departamento')
            ->with('alert', 'Registro eliminado con exito!');
	}

}

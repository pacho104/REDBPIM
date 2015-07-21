<?php namespace App\Http\Controllers;

use App\Departamento;
use App\Http\Requests;
use App\Municipio;

class MunicipioController extends Controller {

    /**
     * Método contructor que determina que las funciones de la clase DepartamentoController las
     * puede usar un usuario autenticado en el sistema utilizando el middelware auth.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra los Municipios que se encuentran en la BD para realizar el respectivo CRUD - Metodo index().
     * @return Vista municipios
     */
	public function index()
	{
        $municipio = \DB::table('municipio')
            ->join('departamento', 'municipio.id_departamento', '=', 'departamento.id')
            ->select('municipio.*', 'departamento.nom_departamento')
            ->orderBy('municipio.id', 'asc')->paginate(8);

        return view('template.CRUD_municipio.municipio')
            ->with('municipio', $municipio);
	}

    /**
     * Redirecciona a la vista new municipio para crear un  nuevo municipio - Metodo create()
     * @return view new_municipio
     */
	public function create()
	{
        $list_dep = Departamento::lists('nom_departamento', 'id');
        return view('template.CRUD_municipio.new_municipio')
            ->with('list_dep',$list_dep);
	}

    /**
     * Realiza las validaciones necesarios en el momento de guardar un nuevo municipio usando el recurso \Validator
     * Guardar un nuevo municipio - Metodo Store()
     * @return Redirecciona a la view principal Municipio luego de Guardar los cambios
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
	 */
	public function show($id)
	{
		//
	}

    /**
     * Muestra la vista principal para editar un municipio - Metodo edit()     *
     * @param  int $id - el id primary key tabla municipio
     * @return vista de edicion municipio
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
     * Actualiza los campos realizados en la vista edit_municipio
     * Realiza las validaciones necesarios utilzando el recurso \Validator
     * @param  int $id - primary Key tabla municipio
     * @return Redirecciona a la vista principal de municipio luego de guardar los cambios
     */
	public function update($id)
	{
        $data = \Request::all();
        $rules = array(
            'codigo_dane_municipio' => "required|max:11|unique:municipio,cod_dane_mun,$id",
            'codigo_dane_municipio' => 'integer',
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
     * Elimina un registro de la tabla municipio - Metodo destroy()
     * Realiza las validaciones usando el recurso \Validator
     * @param  int $id - primary key tabla municipio
     * @return Redirecciona a la vista principal de municipio luego de eliminar el registro
     */
	public function destroy($id)
	{
        $data = array(
            'id_mun' => "$id"
        );
        $rules = array(
            'id_mun' => 'exists:users,id_municipio',
        );

        $ifExistsMunInUsersTable = \Validator::make($data, $rules);

        if ($ifExistsMunInUsersTable->passes())
        {
            return \Redirect::route('municipio')
                ->with('ValidationDelete1', 'No se puede eliminar el registro seleccionado ya que el Municipio tiene usuarios asignados.!');
        } else {
            $municipio = Municipio::find($id)->delete();
            return \Redirect::route('municipio')
                ->with('alert', 'Registro eliminado con exito!');
        }
    }
}

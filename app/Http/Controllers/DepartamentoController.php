<?php namespace App\Http\Controllers;

use App\Departamento;
use App\Http\Requests;

class DepartamentoController extends Controller {

    /**
     * Método contructor que determina que las funciones de la clase DepartamentoController
     * Estas funciones las puede usar un usuario autenticado en el sistema utilizando el middelware auth.
     * Tambien las podrá utilizar solo un usuario tipo admin ya que utiliza el middelware admin
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

	/**
     * Muestra los Departamentos que se encuentran en la BD para realizar el respectivo CRUD - Metodo index().
     * @return Vista departamento
     */
	public function index()
	{
        $departamento = \DB::table('departamento')->orderBy('id', 'asc')->paginate(8);
        return view('template.CRUD_departamento.departamento')
            ->with('departamento', $departamento);
    }

	/**
     * Redirecciona a la vista new departamento para crear un  nuevo departamento - Metodo create()
     * @return view new_departamento
     */
	public function create()
	{
        return view('template.CRUD_departamento.new_departamento');
    }

	/**
     * Realiza las validaciones necesarios en el momento de guardar un nuevo departamento usando el recurso \Validator
     * Guardar un nuevo departamento - Metodo Store()
     * @return Redirecciona a la view principal Departamento luego de Guardar los cambios
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
     * Muestra la vista principal para editar un departamento - Metodo edit()     *
     * @param  int $id - el id primary key tabla departamento
     * @return vista de edicion departamento
     */
	public function edit($id)
	{
        $dep = Departamento::find($id);
        return view('template.CRUD_departamento.edit_departamento')
             ->with('dep', $dep);
	}

	/**
     * Actualiza los campos realizados en la vista edit_departamento
     * Realiza las validaciones necesarios utilzando el recurso \Validator
     * @param  int $id - primary Key tabla departamento
     * @return Redirecciona a la vista principal de departamento luego de guardar los cambios
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
     * Elimina un registro de la tabla departamento - Metodo destroy()
     * Realiza las validaciones usando el recurso \Validator
     * @param  int $id - primary key tabla departamento
     * @return Redirecciona a la vista principal de departamento luego de eliminar el registro
     */
	public function destroy($id)
	{
        $data = array(
            'id_dep' => "$id"
        );
        $rules = array(
            'id_dep' => 'exists:municipio,id_departamento',
        );

        $ifExistsDepInMunTable = \Validator::make($data, $rules);

        if ($ifExistsDepInMunTable->passes())
        {
            return \Redirect::route('departamento')
                   ->with('ValidationDelete', 'No se puede eliminar el registro seleccionado ya que el Departamento tiene Municipios asignados.!');
        }
        else
        {
            $post = Departamento::find($id)->delete();
            return \Redirect::route('departamento')
                   ->with('alert', 'Registro eliminado con exito!');
        }
	}

}

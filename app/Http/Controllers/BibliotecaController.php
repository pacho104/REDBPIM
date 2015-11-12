<?php namespace App\Http\Controllers;

use App\Bibliotecas;
use App\Departamento;
use App\Http\Requests;

class BibliotecaController extends Controller
{


    /**
     * Método contructor que determina  las funciones de la clase BibliotecaController
     * Estas funciones puede usar un usuario autenticado en el sistema utilizando el middelware auth.
     * Tambien las podrá utilizar solo un usuario tipo admin ya que utiliza el middelware admin
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Muestra la tabla bibliotecas registradas en la BD para realizar el respectivo CRUD - Metodo index().
     * Realiza un Join con Departamento para determinar el departamento al cuál aplica la notica y morstrarlo
     * @return Vista biblioteca
     */
    public function index()
    {
        $biblioteca = \DB::table('biblioteca')
            ->join('departamento', 'biblioteca.id_departamento', '=', 'departamento.id')
            ->select('biblioteca.*', 'departamento.nom_departamento')
            ->orderBy('id', 'desc')
            ->paginate(3);

        return view('template.CRUD_biblioteca.biblioteca')
            ->with('biblioteca', $biblioteca);
    }

    /**
     * Redirecciona a la vista new_biblioteca para crear una nueva noticia en la BD - Metodo create()
     * @return view new_biblioteca
     */
    public function create()
    {
        $list_dep = Departamento::lists('nom_departamento', 'id');
        return view('template.CRUD_biblioteca.new_biblioteca')
            ->with('list_dep', $list_dep);
    }

    /**
     * Realiza las validaciones necesarios en el momento de guardar una nueva biblioteca usando el recurso \Validator
     * Guardar una nueva biblioteca - Metodo Store()
     * @return Redirecciona a la view principal Biblioteca luego de Guardar los cambios
     */
    public function store()
    {
        $data = \Request::all();
        $rules = array(
            'titulo_biblioteca' => 'required|max:100',
            'documento_biblioteca' => 'required',
            'departamento' => 'exists:departamento,id',
        );

        $error = \Validator::make($data, $rules);

        if ($error->fails()) {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

        $p = new Bibliotecas;
        $p->titulo_biblioteca = \Input::get('titulo_biblioteca');
        $p->documento_biblioteca = \Input::get('documento_biblioteca');
        $p->id_departamento = \Input::get('departamento');
        $p->save();

        return \Redirect::route('biblioteca')
                ->with('alert', 'Registro creado con exito!');
    }

    /**
     * Muestra la vista principal para editar una biblioteca - Metodo edit()     *
     * @param  int $id - el id primary key tabla biblioteca
     * @return vista de edicion biblioteca
     */
    public function edit($id)
    {
        $list_dep = Departamento::lists('nom_departamento', 'id');
        $biblioteca = Bibliotecas::find($id);
        return view('template.CRUD_biblioteca.edit_biblioteca')
            ->with('biblioteca', $biblioteca)
            ->with('list_dep', $list_dep);
    }

    /**
     * Actualiza los campos realizados en la vista edit_biblioteca
     * Realiza las validaciones necesarios utilzando el recurso \Validator
     * @param  int $id - primary Key tabla biblioteca
     * @return Redirecciona a la vista principal de biblioteca luego de guardar los cambios
     */
    public function update($id)
    {
        $data = \Request::all();
        $rules = array(
            'titulo_biblioteca' => 'required|max:150',
            'documento_biblioteca' => 'required',
            'departamento' => 'exists:departamento,id',
        );
        $error = \Validator::make($data, $rules);

        if ($error->fails()) {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

        $p = Bibliotecas::find($id);
        $p->titulo_biblioteca = \Input::get('titulo_biblioteca');
        $p->documento_biblioteca = \Input::get('documento_biblioteca');
        $p->id_departamento = \Input::get('departamento');
        $p->save();

        return \Redirect::route('biblioteca')
            ->with('alert', 'Actualización realizada exitosamente!');
    }

    /**
     * Elimina un registro de la tabla biblioteca - Metodo destroy()
     * @param  int $id - primary key tabla biblioteca
     * @return Redirecciona a la vista principal de biblioteca luego de eliminar el registro
     */
    public function destroy($id)
    {
        $bibliot = Bibliotecas::find($id)->delete();
        return \Redirect::route('biblioteca')
            ->with('alert', 'Registro eliminado con exito!');
    }


}

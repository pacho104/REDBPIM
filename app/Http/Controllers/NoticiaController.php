<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Noticia;

class NoticiaController extends Controller
{

    /**
     * Método contructor que determina que las funciones de la clase NoticiaController las
     * puede usar un usuario autenticado en el sistema utilizando el middelware auth.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra los Departamentos que se encuentran en la BD para realizar el respectivo CRUD - Metodo index().
     * @return Vista noticia
     */
    public function index()
    {
        $noticia = \DB::table('noticia')->orderBy('id', 'asc')->paginate(3);
        return view('template.CRUD_noticia.noticia')
            ->with('noticia', $noticia);
    }

    /**
     * Redirecciona a la vista new_noticia para crear una nueva noticia en la BD - Metodo create()
     * @return view new_noticia
     */
    public function create()
    {
        return view('template.CRUD_noticia.new_noticia');
    }

    /**
     * Realiza las validaciones necesarios en el momento de guardar una nueva noticia usando el recurso \Validator
     * Guardar una nueva noticia - Metodo Store()
     * @return Redirecciona a la view principal Noticia luego de Guardar los cambios
     */
    public function store()
    {
        $data = \Request::all();
        $rules = array(
            'titulo_noticia' => 'required|max:150',
            'contenido_noticia' => 'required',
        );

        $error = \Validator::make($data, $rules);

        if ($error->fails()) {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

        $p = new Noticia;
        $p->titulo_noticia = \Input::get('titulo_noticia');
        $p->cuerpo_noticia = \Input::get('contenido_noticia');
        $p->save();

        return \Redirect::route('noticia')
            ->with('alert', 'Registro creado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Muestra la vista principal para editar una noticia - Metodo edit()     *
     * @param  int $id - el id primary key tabla noticia
     * @return vista de edicion noticia
     */
    public function edit($id)
    {
        $noticia = Noticia::find($id);
        return view('template.CRUD_noticia.edit_noticia')
            ->with('noticia', $noticia);
    }

    /**
     * Actualiza los campos realizados en la vista edit_noticia
     * Realiza las validaciones necesarios utilzando el recurso \Validator
     * @param  int $id - primary Key tabla noticia
     * @return Redirecciona a la vista principal de noticia luego de guardar los cambios
     */
    public function update($id)
    {
        $data = \Request::all();
        $rules = array(
            'titulo_noticia' => 'required|max:150',
            'contenido_noticia' => 'required',
        );
        $error = \Validator::make($data, $rules);

        if ($error->fails()) {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

        $p = Noticia::find($id);
        $p->titulo_noticia = \Input::get('titulo_noticia');
        $p->cuerpo_noticia = \Input::get('contenido_noticia');
        $p->save();

        return \Redirect::route('noticia')
            ->with('alert', 'Actualización realizada exitosamente!');
    }

    /**
     * Elimina un registro de la tabla noticia - Metodo destroy()
     * Realiza las validaciones usando el recurso \Validator
     * @param  int $id - primary key tabla noticia
     * @return Redirecciona a la vista principal de noticia luego de eliminar el registro
     */
    public function destroy($id)
    {
        $data = array(
            'id_noticia' => "$id"
        );
        $rules = array(
            'id_noticia' => 'exists:red_departamental,id_noticia',
        );

        $ifExistsNoticiaInRedDepartamentalTable = \Validator::make($data, $rules);

        if ($ifExistsNoticiaInRedDepartamentalTable->passes()) {
            return \Redirect::route('noticia')
                ->with('ValidationNoticia', 'No se puede eliminar el registro seleccionado ya que la Noticia se encuentra presente en la Red Departamental.!');
        } else {
            $noti = Noticia::find($id)->delete();
            return \Redirect::route('noticia')
                ->with('alert', 'Registro eliminado con exito!');
        }
    }

}

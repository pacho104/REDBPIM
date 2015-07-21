<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\TipoIdentificacion;

class TipoIdentificacionController extends Controller
{

    /**
     * Método contructor que determina que las funciones de la clase TipoIdentificacionController las
     * puede usar un usuario autenticado en el sistema utilizando el middelware auth.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra los campos de Tipo de Identificacion de usuario
     * que se encuentran en la BD para realizar el respectivo CRUD - Metodo index().
     * @return Vista tipo_identificacion
     */
    public function index()
    {
        $tip_identificacion = \DB::table('tipo_identificacion')->orderBy('id', 'asc')->paginate(8);
        return view('template.CRUD_tipoIdentificacion.tipoIdentificacion')
            ->with('tip_identificacion', $tip_identificacion);
    }

    /**
     * Redirecciona a la vista new tipo_identificacion para crear un  nuevo tipo de identificacion - Metodo create()
     * @return view new_tipoIdentificacion
     */
    public function create()
    {
        return view('template.CRUD_tipoIdentificacion.new_tipoIdentificacion');
    }

    /**
     * Realiza las validaciones necesarios en el momento de guardar un nuevo tipo de identificacion usando el recurso \Validator
     * Guardar un nuevo tipo de identificacion - Metodo Store()
     * @return Redirecciona a la view principal tipoIdentificacion luego de Guardar los cambios
     */
    public function store()
    {
        $data = \Request::all();
        $rules = array(
            'nombre_identificacion' => 'required|max:45|unique:tipo_identificacion,nom_identificacion',
        );

        $error = \Validator::make($data, $rules);

        if ($error->fails()) {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

        $p = new TipoIdentificacion;
        $p->nom_identificacion = \Input::get('nombre_identificacion');
        $p->save();

        return \Redirect::route('tipoIdentificacion')
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
     * Muestra la vista principal para editar un  tipo de identificacion - Metodo edit()     *
     * @param  int $id - el id primary key tabla tipo_identificacion
     * @return vista de edicion edit_tipoIdentificacion
     */
    public function edit($id)
    {
        $tipIden = TipoIdentificacion::find($id);
        return view('template.CRUD_tipoIdentificacion.edit_tipoIdentificacion')
            ->with('tipIden', $tipIden);
    }

    /**
     * Actualiza los campos realizados en la vista edit_tipoIdentificacion
     * Realiza las validaciones necesarios utilzando el recurso \Validator
     * @param  int $id - primary Key tabla tipo_identificacion
     * @return Redirecciona a la vista principal de tipoIdentificacion luego de guardar los cambios
     */
    public function update($id)
    {
        $data = \Request::all();
        $rules = array(
            'nombre_identificacion' => "required|max:45|unique:tipo_identificacion,nom_identificacion,$id",
        );
        $error = \Validator::make($data, $rules);

        if ($error->fails()) {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

        $p = TipoIdentificacion::find($id);
        $p->nom_identificacion = \Input::get('nombre_identificacion');
        $p->save();

        return \Redirect::route('tipoIdentificacion')
            ->with('alert', 'Actualización realizada exitosamente!');
    }

    /**
     * Elimina un registro de la tabla tipo_identificacion - Metodo destroy()
     * Realiza las validaciones usando el recurso \Validator
     * @param  int $id - primary key tabla tipo_identificacion
     * @return Redirecciona a la vista principal de tipoIdentificacion luego de eliminar el registro
     */
    public function destroy($id)
    {
        $data = array(
            'id_identificacion' => "$id"
        );
        $rules = array(
            'id_identificacion' => 'exists:users,id_tipo_identificacion',
        );

        $ifExistsCargoInUsersTable = \Validator::make($data, $rules);

        if ($ifExistsCargoInUsersTable->passes()) {
            return \Redirect::route('tipoIdentificacion')
                ->with('ValidationDeleteIdentificacion', 'No se puede eliminar el registro seleccionado ya que el tipo de identificación tiene usuarios asignados.!');
        } else {
            $tipoIdentif = TipoIdentificacion::find($id)->delete();
            return \Redirect::route('tipoIdentificacion')
                ->with('alert', 'Registro eliminado con exito!');
        }
    }

}

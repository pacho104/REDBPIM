<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Secretaria;
use Illuminate\Http\Request;

class TipoSecretariaController extends Controller
{

    /**
     * Método contructor que determina que las funciones de la clase TipoSecretariaController las
     * puede usar un usuario autenticado en el sistema utilizando el middelware auth.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Muestra los campos de Tipo de Secretaria que se encuentran en la BD para realizar el respectivo CRUD - Metodo index().
     * @return Vista tipoSecretaria
     */
    public function index(Request $request)
    {
        $tip_secretaria =Secretaria::filtroAndPaginacion($request->get('secre'));
        return view('template.CRUD_tipoSecretaria.tipoSecretaria')
            ->with('tip_secretaria', $tip_secretaria);
    }

    /**
     * Redirecciona a la vista new_tipoSecretaria para crear un  nuevo tipo de secretaria - Metodo create()
     * @return view new_tipoSecretaria
     */
    public function create()
    {
        return view('template.CRUD_tipoSecretaria.new_tipoSecretaria');
    }

    /**
     * Realiza las validaciones necesarios en el momento de guardar un nuevo tipo de secretaria usando el recurso \Validator
     * Guardar un nuevo tipo de secretaria - Metodo Store()
     * @return Redirecciona a la view principal tipoSecetaria luego de Guardar los cambios
     */
    public function store()
    {
        $data = \Request::all();
        $rules = array(
            'nombre_secretaria' => 'required|max:60|unique:tipo_secretaria,nombre_secretaria',
        );

        $error = \Validator::make($data, $rules);

        if ($error->fails()) {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

        $p = new Secretaria;
        $p->nombre_secretaria = \Input::get('nombre_secretaria');
        $p->save();

        return \Redirect::route('tipoSecretaria')
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
     * Muestra la vista principal para editar un  tipo de secretaria - Metodo edit()     *
     * @param  int $id - el id primary key tabla tipo_secretaria
     * @return vista de edicion edit_tipoSecetaria
     */
    public function edit($id)
    {
        $tipSecre = Secretaria::find($id);
        return view('template.CRUD_tipoSecretaria.edit_tipoSecretaria')
            ->with('tipSecre', $tipSecre);
    }

    /**
     * Actualiza los campos realizados en la vista edit_tipoSecretaria
     * Realiza las validaciones necesarios utilzando el recurso \Validator
     * @param  int $id - primary Key tabla tipo_Secretaria
     * @return Redirecciona a la vista principal de tipoSecretaria luego de guardar los cambios
     */
    public function update($id)
    {
        $data = \Request::all();
        $rules = array(
            'nombre_secretaria' => "required|max:60|unique:tipo_secretaria,nombre_secretaria,$id",
        );
        $error = \Validator::make($data, $rules);

        if ($error->fails()) {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

        $p = Secretaria::find($id);
        $p->nombre_secretaria = \Input::get('nombre_secretaria');
        $p->save();

        return \Redirect::route('tipoSecretaria')
            ->with('alert', 'Actualización realizada exitosamente!');
    }

    /**
     * Elimina un registro de la tabla tipo_Secretaria - Metodo destroy()
     * Realiza las validaciones usando el recurso \Validator
     * @param  int $id - primary key tabla tipo_secretaria
     * @return Redirecciona a la vista principal de tipoSecretaria luego de eliminar el registro
     */
    public function destroy($id)
    {
        $data = array(
            'id_secretaria' => "$id"
        );
        $rules = array(
            'id_secretaria' => 'exists:users,id_tipo_secretaria',
        );

        $ifExistsSecretariaInUsersTable = \Validator::make($data, $rules);

        if ($ifExistsSecretariaInUsersTable->passes()) {
            return \Redirect::route('tipoSecretaria')
                ->with('ValidationDeleteSecretaria', 'No se puede eliminar el registro seleccionado ya que el tipo de secretaría tiene usuarios asignados.!');
        } else {
            $tipoSec = Secretaria::find($id)->delete();
            return \Redirect::route('tipoSecretaria')
                ->with('alert', 'Registro eliminado con exito!');
        }
    }

}

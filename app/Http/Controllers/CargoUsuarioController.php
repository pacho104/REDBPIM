<?php namespace App\Http\Controllers;

use App\CargoUsuario;
use App\Http\Requests;

class CargoUsuarioController extends Controller
{

    /**
     * Método contructor que determina que las funciones de la clase CargoUsuarioController las
     * puede usar un usuario autenticado en el sistema utilizando el middelware auth.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra los Cargos de usuario que se encuentran en la BD para realizar el respectivo CRUD - Metodo index().
     * @return Vista cargo_usuario
     */
    public function index()
    {
        $cargo_usuario = \DB::table('cargo_usuario')->orderBy('id', 'asc')->paginate(8);
        return view('template.CRUD_CargoUsuario.cargoUsuario')
            ->with('cargo_usuario', $cargo_usuario);
    }

    /**
     * Redirecciona a la vista new cargo_usuario para crear un  nuevo cargo - Metodo create()
     * @return view new_cargoUsuario
     */
    public function create()
    {
        return view('template.CRUD_CargoUsuario.new_cargoUsuario');
    }

    /**
     * Realiza las validaciones necesarios en el momento de guardar un nuevo cargo usando el recurso \Validator
     * Guardar un nuevo cargo - Metodo Store()
     * @return Redirecciona a la view principal cargoUsuario luego de Guardar los cambios
     */
    public function store()
    {
        $data = \Request::all();
        $rules = array(
            'nombre_cargo' => 'required|max:100|unique:cargo_usuario,nom_cargo',
        );

        $error = \Validator::make($data, $rules);

        if ($error->fails()) {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

        $p = new CargoUsuario;
        $p->nom_cargo = \Input::get('nombre_cargo');
        $p->save();

        return \Redirect::route('cargoUsuario')
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
     * Muestra la vista principal para editar un cargo - Metodo edit()     *
     * @param  int $id - el id primary key tabla cargo_usuario
     * @return vista de edicion cargo_usuario
     */
    public function edit($id)
    {
        $cargo = CargoUsuario::find($id);
        return view('template.CRUD_CargoUsuario.edit_cargoUsuario')
            ->with('cargo', $cargo);
    }

    /**
     * Actualiza los campos realizados en la vista edit_cargoUsuario
     * Realiza las validaciones necesarios utilzando el recurso \Validator
     * @param  int $id - primary Key tabla cargo_usuario
     * @return Redirecciona a la vista principal de cargoUsuario luego de guardar los cambios
     */
    public function update($id)
    {
        $data = \Request::all();
        $rules = array(
            'nombre_cargo' => "required|max:100|unique:cargo_usuario,nom_cargo,$id",
        );
        $error = \Validator::make($data, $rules);

        if ($error->fails()) {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

        $p = CargoUsuario::find($id);
        $p->nom_cargo = \Input::get('nombre_cargo');
        $p->save();

        return \Redirect::route('cargoUsuario')
            ->with('alert', 'Actualización realizada exitosamente!');
    }

    /**
     * Elimina un registro de la tabla cargo_usuario - Metodo destroy()
     * Realiza las validaciones usando el recurso \Validator
     * @param  int $id - primary key tabla cargo_usuario
     * @return Redirecciona a la vista principal de cargoUsuario luego de eliminar el registro
     */
    public function destroy($id)
    {
        $data = array(
            'id_cargo' => "$id"
        );
        $rules = array(
            'id_cargo' => 'exists:users,id_cargo_usuario',
        );

        $ifExistsCargoInUsersTable = \Validator::make($data, $rules);

        if ($ifExistsCargoInUsersTable->passes()) {
            return \Redirect::route('cargoUsuario')
                ->with('ValidationDeleteCargo', 'No se puede eliminar el registro seleccionado ya que el Cargo tiene usuarios asignados.!');
        } else {
            $cargouser = CargoUsuario::find($id)->delete();
            return \Redirect::route('cargoUsuario')
                ->with('alert', 'Registro eliminado con exito!');
        }
    }

}

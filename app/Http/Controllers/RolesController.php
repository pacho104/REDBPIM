<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Permission;
use App\Role;
use Illuminate\Support\Facades\View;


class RolesController extends Controller {


    public function __construct()
    {
       /*    ('ver_roles', array('only' => 'index') );
             ('crear_roles', array('only' => 'create') );
             ('crear_roles', array('only' => 'store') );
             ('editar_roles', array('only' => 'edit') );
             ('editar_roles', array('only' => 'update') );
             ('eliminar_roles', array('only' => 'delete') );
       */
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = Role::paginate(8);
        $permisos= Permission::all();
        return View::make('template.role.role', array('roles' => $roles, 'permisos'=>$permisos));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('template.role.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $role = new Role();
        $role->name = Input::get('name');
        $role->save();

        return Redirect::route('template.role.index');
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
        return View::make('template.role.edit', array('role' => Role::find($id)));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $role = Role::find($id);
        $role->name = Input::get('name');
        $role->save();
        return Redirect::route('template.role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Role::destroy($id);
        return Redirect::route('template.role.index');
    }


}

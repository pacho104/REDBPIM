<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SubPrograma;
use Illuminate\Http\Request;

class SubProgramaController extends Controller {


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('plan_desarrollo');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

    public function getIdPrograma()
    {
        $get_eje = \DB::table('eje_estrategico')
            ->select('id')
            ->where('id_plan_de_desarrollo', '=', \Session::get('id_plan'))
            ->get();

        $id_eje = array_map(function ($get_id_eje) {return $get_id_eje->id;}, $get_eje);

       $get_programa = \DB::table('programa')
                        ->select('id')
                        ->whereIn('id_eje_estrategico', $id_eje)
                        ->get();

        $id_programa = array_map(function ($get_id_program) {return $get_id_program->id;}, $get_programa);

        \Session::put('id_programa',$id_programa);

        return $id_programa;
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $list_programa = \DB::table('programa')
                        ->whereIn('id',$this->getIdPrograma())
                        ->lists('nombre_programa','id');

		return view('template.PlanDesarrollo.subPrograma.new_SubPrograma')
        ->with('list_programa',$list_programa);
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
            'codigo_subPrograma' => 'required|numeric',
            'nombre_subPrograma' => 'required|max:200',
            'programa' => 'exists:programa,id',
        );

        $error = \Validator::make($data,$rules);

        if($error->fails())
        {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

        $SubProgram = new SubPrograma;
        $SubProgram->codigo_sub_programa = \Input::get('codigo_subPrograma');
        $SubProgram->nombre_sub_programa = \Input::get('nombre_subPrograma');
        $SubProgram->id_programa = \Input::get('programa');
        $SubProgram ->save();

        return \Redirect::back()
            ->with('alert', 'Registro creado con exito!');
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
        $list_programa = \DB::table('programa')
                        ->whereIn('id',$this->getIdPrograma())
                        ->lists('nombre_programa','id');

        $subPrograma = SubPrograma::find($id);

        return view('template.PlanDesarrollo.subPrograma.edit_subPrograma')
                    ->with('list_programa',$list_programa)
                    ->with('subPrograma',$subPrograma);
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
            'nombre_sub_programa' => 'required|numeric',
            'nombre_sub_programa' => 'required|max:200',
            'programa' => 'exists:programa,id',
        );
        $error = \Validator::make($data, $rules);

        if ($error->fails()) {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

        $p = SubPrograma::find($id);
        $p->codigo_sub_programa = \Input::get('codigo_sub_programa');
        $p->nombre_sub_programa = \Input::get('nombre_sub_programa');
        $p->id_programa = \Input::get('programa');
        $p->save();

        return \Redirect::route('plan_desarrollo')
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
        $data = array(
            'id_sub_programa' => "$id"
        );
        $rules = array(
            'id_sub_programa' => 'exists:meta_subProgramas,id_sub_programa',
        );

        $ifExistsSubProgramaInMetaTable = \Validator::make($data, $rules);

        if ($ifExistsSubProgramaInMetaTable->passes())
        {
            return \Redirect::back()
                ->with('ValidationDelete', 'No se puede eliminar el registro seleccionado ya que el SubPrograma tiene meta(s) asignada(s)..!');
        }

        $post = SubPrograma::find($id)->delete();
        return \Redirect::route('plan_desarrollo')
            ->with('alert', 'Registro eliminado con exito!');
	}

}

<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Programa;

use Illuminate\Http\Request;

class ProgramaController extends Controller {

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

    public function getIdEjeEstrategico()
    {
        $get_eje = \DB::table('eje_estrategico')
            ->select('id')
            ->where('id_plan_de_desarrollo', '=', \Session::get('id_plan'))
            ->get();

        $id_eje = array_map(function ($get_id_eje)
        {
            return $get_id_eje->id;
        }, $get_eje);

        return $id_eje;
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
      $list_eje = \DB::table('eje_estrategico')
                    ->whereIn('id',$this->getIdEjeEstrategico())
                    ->lists('nombre_eje','id');

		return view('template.PlanDesarrollo.programa.new_programa')
                ->with('list_eje',$list_eje);
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
            'codigo_programa' => 'required|numeric',
            'nombre_programa' => 'required|max:200',
            'eje_estrategico' => 'exists:eje_estrategico,id',
        );

        $error = \Validator::make($data,$rules);

        if($error->fails())
        {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

        $Program = new Programa;
        $Program->codigo_programa = \Input::get('codigo_programa');
        $Program->nombre_programa = \Input::get('nombre_programa');
        $Program->id_eje_estrategico = \Input::get('eje_estrategico');
        $Program ->save();

        return \Redirect::back()
            ->with('alert', 'Registro creado con exito!');
	}

    public function nextPrograma()
    {
        $variable = \DB::table('programa')
            ->whereIn('id_eje_estrategico', $this->getIdEjeEstrategico())
            ->first();

        if(is_null($variable))
        {
            return \Redirect::back()
                ->with('alertError', 'Debe registrar al menos un programa!');
        }
        else
        {
            return \Redirect::route('new_subPrograma');
        }
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
        $list_eje = \DB::table('eje_estrategico')
                    ->whereIn('id',$this->getIdEjeEstrategico())
                    ->lists('nombre_eje','id');

        $programa = Programa::find($id);

        return view('template.PlanDesarrollo.programa.edit_programa')
                ->with('programa', $programa)
                ->with('list_eje', $list_eje);
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
            'codigo_programa' => 'required|numeric',
            'nombre_programa' => 'required|max:200',
            'eje_estrategico' => 'exists:eje_estrategico,id',
        );
        $error = \Validator::make($data, $rules);

        if ($error->fails()) {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

        $p = Programa::find($id);
        $p->codigo_programa = \Input::get('codigo_programa');
        $p->nombre_programa = \Input::get('nombre_programa');
        $p->id_eje_estrategico = \Input::get('eje_estrategico');
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
            'id_programa' => "$id"
        );
        $rules = array(
            'id_programa' => 'exists:sub_programa,id_programa',
            'id_programa' => 'exists:meta_programas,id_programa',
        );

        $ifExistsProgramaInSubProgramaoMetaTable = \Validator::make($data, $rules);

        if ($ifExistsProgramaInSubProgramaoMetaTable->passes())
        {
            return \Redirect::back()
                ->with('ValidationDelete', 'No se puede eliminar el registro seleccionado ya que el eje programa tiene subprogramas o metas asignadas. Verifique esto.!');
        }

            $post = Programa::find($id)->delete();
            return \Redirect::route('plan_desarrollo')
                ->with('alert', 'Registro eliminado con exito!');

	}

}

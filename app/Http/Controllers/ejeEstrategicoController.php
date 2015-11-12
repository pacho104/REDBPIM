<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\EjeEstrategico;
use Illuminate\Http\Request;

class ejeEstrategicoController extends Controller {

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

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
       return view('template.PlanDesarrollo.eje_estrategico.new_eje_estrategico');
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
            'codigo_eje' => 'required|numeric',
            'nombre_eje' => 'required|max:200',
        );

        $error = \Validator::make($data,$rules);

        if($error->fails())
        {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

        $ejeEstra = new EjeEstrategico;
        $ejeEstra->codigo_eje = \Input::get('codigo_eje');
        $ejeEstra->nombre_eje = \Input::get('nombre_eje');
        $ejeEstra->id_plan_de_desarrollo = \Session::get('id_plan');
        $ejeEstra ->save();

        return \Redirect::back()
            ->with('alert', 'Registro creado con exito!');
    }

    public function nextEje()
    {
        $variable = \DB::table('eje_estrategico')
                    ->where('id_plan_de_desarrollo', '=', \Session::get('id_plan'))
                    ->first();

        if(is_null($variable))
        {
            return \Redirect::back()
                   ->with('alertError', 'Debe registrar al menos un eje estratégico!');
        }
        else
        {
            return \Redirect::route('new_programa');
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
        $eje = EjeEstrategico::find($id);
        return view('template.PlanDesarrollo.eje_estrategico.edit_eje_estrategico')
            ->with('eje', $eje);
	}

	/**
	 * Update the specified resource in storage.
	 * @param  int  $id
	 * @return Response
	 */

	public function update($id)
	{
        $data = \Request::all();
        $rules = array(
            'codigo_eje' => 'required|numeric',
            'nombre_eje' => 'required',
        );
        $error = \Validator::make($data, $rules);

        if ($error->fails()) {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

        $p = EjeEstrategico::find($id);
        $p->codigo_eje = \Input::get('codigo_eje');
        $p->nombre_eje = \Input::get('nombre_eje');
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
            'id_eje' => "$id"
        );
        $rules = array(
            'id_eje' => 'exists:programa,id_eje_estrategico',
        );

        $ifExistsProgramaInEjeTable = \Validator::make($data, $rules);

        if ($ifExistsProgramaInEjeTable->passes())
        {
            return \Redirect::back()
                ->with('ValidationDelete', 'No se puede eliminar el registro seleccionado ya que el eje estratégico tiene programa(s) asignado(s).!');
        }
        else
        {
            $post = EjeEstrategico::find($id)->delete();
            return \Redirect::route('plan_desarrollo')
                ->with('alert', 'Registro eliminado con exito!');
        }
	}

}

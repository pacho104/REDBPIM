<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PlanDesarrollo;

use Illuminate\Http\Request;

class planDesarrolloController extends Controller {

	/**
	 * Display a listing of the resource.
	 * Muestra la vista principal para Gestionar un Plan de Desarrollo
	 * @return Response
	 */
	public function indexMainPlanDesarrollo()
	{
        \Session::forget('id_existe_plan');

       $plan_desarrollo = \DB::table('plan_de_desarrollo')
                            ->join('municipio', 'plan_de_desarrollo.id_municipio', '=', 'municipio.id')
                            ->select('plan_de_desarrollo.*', 'municipio.nom_municipio')
                            ->where('plan_de_desarrollo.id_municipio', '=', \Auth::user()->id_municipio)
                            ->orderBy('plan_de_desarrollo.id', 'desc')->paginate(1);

		return view('template.PlanDesarrollo.index_planDesarrollo')
                    ->with('plan_desarrollo',$plan_desarrollo);
	}

    /**
     * Display a listing of the resource.
     * Muestra la vista principal para Gestionar un Plan de Desarrollo
     * @return Response
     */
     public function PrincipalEliminarPlanDesarrollo($id)
    {
        $data = array(
            'id_plan' => "$id"
        );
        $rules = array(
            'id_plan' => 'exists:eje_estrategico,id_plan_de_desarrollo',
        );

        $ifExistsEjeInPlanTable = \Validator::make($data, $rules);

        if ($ifExistsEjeInPlanTable->passes())
        {
            return \Redirect::back()
                ->with('ValidationDelete', 'No se puede eliminar el registro seleccionado ya que el Plan de desarrollo tiene eje(s) estratégico(s) asignado(s).!');
        } else {
            $post = PlanDesarrollo::find($id)->delete();
            return \Redirect::route('plan_desarrollo')
                ->with('alert', 'Registro eliminado con exito!');
        }
    }

    /**
     * Display a listing of the resource.
     * Muestra la vista principal para Gestionar un Plan de Desarrollo
     * @return Response
     */
    public function nuevoPlanMunicipal()
    {
        \Session::forget('id_plan');
         return view('template.PlanDesarrollo.registrar_plan.new_plan');
    }

    /**
     * Display a listing of the resource.
     * Muestra la vista principal para Gestionar un Plan de Desarrollo
     * @return Response
     */
    public function storePlanDesarrolloMunicipal()
    {
        $data = \Request::all();
        $rules = array(
            'codigo_plan' => 'required|numeric',
            'nombre_plan' => 'required',
        );

        $error = \Validator::make($data,$rules);

        if($error->fails())
        {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

        $planDes = new PlanDesarrollo;
        $planDes->codigo_plan = \Input::get('codigo_plan');
        $planDes->nombre_plan = \Input::get('nombre_plan');
        $planDes->id_municipio = \Auth::user()->id_municipio;
        $planDes ->save();

        \Session::put('id_plan',$planDes->id);
        \Session::put('id_existe_plan',$planDes->id);

        return \Redirect::route('new_eje_estrategico');
    }
    public function edit($id)
    {
        $plan = PlanDesarrollo::find($id);
        return view('template.PlanDesarrollo.registrar_plan.edit_plan')
            ->with('plan', $plan);
    }

    public function update($id)
    {
        $data = \Request::all();
        $rules = array(
            'codigo_plan' => 'required|numeric',
            'nombre_plan' => 'required',
        );
        $error = \Validator::make($data, $rules);

        if ($error->fails()) {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }


        $p = PlanDesarrollo::find($id);
        $p->codigo_plan = \Input::get('codigo_plan');
        $p->nombre_plan = \Input::get('nombre_plan');
        $p->save();


        return \Redirect::route('plan_desarrollo')
            ->with('alert', 'Actualización realizada exitosamente!');
    }

}

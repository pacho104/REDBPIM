<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Meta;
use App\MetaProgramas;
use App\MetaSubProgramas;
use Illuminate\Http\Request;
use Monolog\Handler\NullHandlerTest;

class MetaController extends Controller {

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



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

        $list_programa = \DB::table('programa')
                          ->whereIn('id',\Session::get('id_programa'))
                          ->lists('nombre_programa','id');

        $list_subPrograma = \DB::table('sub_programa')
                            ->whereIn('id_programa',\Session::get('id_programa'))
                            ->lists('nombre_sub_programa','id');

		return view('template.PlanDesarrollo.metas.new_meta')
                    ->with('list_programa',$list_programa)
                    ->with('list_subPrograma',$list_subPrograma);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $request = \Request::all();
        $rules = array(
            'nombre_meta' => 'required|max:45',
            'tipo_meta' => 'required|max:45',
            'valor_meta' => 'required|numeric',
        );

        $error = \Validator::make($request,$rules);

        if($error->fails())
        {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

       if(\Input::get('programa') == 0 AND \Input::get('subPrograma') == 0 )
        {
            return redirect()->back()
                ->withInput(\Request::all())
                ->with('alertError','Debe seleccionar un programa o subPrograma que aplique a la meta');
        }

        $Meta = new Meta;
        $Meta->nombre_meta = \Input::get('nombre_meta');
        $Meta->tipo_meta = \Input::get('tipo_meta');
        $Meta->valor_meta = \Input::get('valor_meta');
        $Meta ->save();

        if(\Input::get('select_programa') == 1 and  \Input::get('programa') != 0)
        {
            $metaProgramas = new MetaProgramas;
            $metaProgramas->id_programa = \Input::get('programa');
            $metaProgramas->id_meta = $Meta->id;
            $metaProgramas->save();
        }
        elseif(\Input::get('select_programa') == 2 and \Input::get('subPrograma') != 0)
        {
            $metaSubProgramas = new MetaSubProgramas;
            $metaSubProgramas->id_sub_programa = \Input::get('subPrograma');
            $metaSubProgramas->id_meta = $Meta->id;
            $metaSubProgramas->save();
        }

            return \Redirect::back()
                ->with('alert', 'Registro creado con exito!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function finish_meta()
	{

        $meta_programa = \DB::table('meta_programas')
                          ->whereIn('id_programa',\Session::get('id_programa'))
                          ->get();

       $subprograma = \DB::table('sub_programa')
                        ->select('id')
                        ->whereIn('id_programa',\Session::get('id_programa'))
                        ->get();

        $id_sub_programa = array_map(function ($get_id_subprograma){ return $get_id_subprograma->id;}, $subprograma);

        $meta_subprograma = \DB::table('meta_subProgramas')
                            ->whereIn('id_sub_programa',$id_sub_programa)
                            ->get();

        if (is_null($meta_programa) and is_null($meta_subprograma))
        {
             return \Redirect::back()
                ->with('alertError', '¡..Debe registrar al menos una meta..!!');
        }

        return \Redirect::route('plan_desarrollo');

    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit_meta_programa($id)
	{
        $meta = Meta::find($id);

        $metaprograma = Meta::find($id)->meta_programa($id);

        $list_programa = \DB::table('programa')
                         ->whereIn('id',\Session::get('id_programa'))
                         ->lists('nombre_programa','id');

        $list_subPrograma = \DB::table('sub_programa')
                            ->whereIn('id_programa',\Session::get('id_programa'))
                            ->lists('nombre_sub_programa','id');

        return view('template.PlanDesarrollo.metas.edit_meta_programas')
            ->with('meta', $meta)
            ->with('metaprograma', $metaprograma)
            ->with('list_programa', $list_programa)
            ->with('list_subPrograma', $list_subPrograma);
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function update_meta_programa($id)
	{
        $request = \Request::all();
        $rules = array(
            'nombre_meta' => 'required|max:45',
            'tipo_meta' => 'required|max:45',
            'valor_meta' => 'required|numeric',
        );

        $error = \Validator::make($request,$rules);

        if($error->fails())
        {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

        if(\Input::get('select_programa') == 2 AND \Input::get('subPrograma') == 0 )
        {
            return redirect()->back()
                ->withInput(\Request::all())
                ->with('alertError','Debe seleccionar un subPrograma que aplique a la meta');
        }

        $p = Meta::find($id);
        $p->nombre_meta = \Input::get('nombre_meta');
        $p->tipo_meta = \Input::get('tipo_meta');
        $p->valor_meta = \Input::get('valor_meta');
        $p->save();

        $meta_programa = Meta::find($id)->meta_programa($id);

        if(\Input::get('select_programa') == 2 AND \Input::get('subPrograma') != 0 )
        {
            $delete_metaprogram = MetaProgramas::find($meta_programa->id)->delete();

            $metaSubPrograma = new MetaSubProgramas;
            $metaSubPrograma->id_sub_programa = \Input::get('subPrograma');
            $metaSubPrograma->id_meta = $p->id;
            $metaSubPrograma->save();
        }
        else
        {
            $m = MetaProgramas::find($meta_programa->id);
            $m->id_programa = \Input::get('programa');
            $m->save();
        }

        return \Redirect::route('plan_desarrollo')
            ->with('alert', 'Actualización realizada exitosamente!');
    }


    public function edit_meta_subPrograma($id)
    {

        $meta = Meta::find($id);

        $meta_subPrograma = Meta::find($id)->meta_sub_programa($id);

        $list_programa = \DB::table('programa')
                        ->whereIn('id',\Session::get('id_programa'))
                        ->lists('nombre_programa','id');

        $list_subPrograma = \DB::table('sub_programa')
                            ->whereIn('id_programa',\Session::get('id_programa'))
                            ->lists('nombre_sub_programa','id');

        return view('template.PlanDesarrollo.metas.edit_meta_subprogramas')
                    ->with('meta', $meta)
                    ->with('meta_subPrograma', $meta_subPrograma)
                    ->with('list_programa', $list_programa)
                    ->with('list_subPrograma', $list_subPrograma);
    }

    public  function update_meta_subPrograma($id)
    {
        $request = \Request::all();
        $rules = array(
            'nombre_meta' => 'required|max:45',
            'tipo_meta' => 'required|max:45',
            'valor_meta' => 'required|numeric',
        );

        $error = \Validator::make($request,$rules);

        if($error->fails())
        {
            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput(\Request::all());
        }

         if(\Input::get('select_programa') == 1 AND \Input::get('programa') == 0 )
        {
            return redirect()->back()
                ->withInput(\Request::all())
                ->with('alertError','Debe seleccionar un Programa que aplique a la meta');
        }

        $p = Meta::find($id);
        $p->nombre_meta = \Input::get('nombre_meta');
        $p->tipo_meta = \Input::get('tipo_meta');
        $p->valor_meta = \Input::get('valor_meta');
        $p->save();

        $meta_subPrograma = Meta::find($id)->meta_sub_programa($id);

        if(\Input::get('select_programa') == 1 AND \Input::get('programa') != 0 )
        {
            $delete_metaSubprogram = MetaSubProgramas::find($meta_subPrograma->id)->delete();

            $metaProgram = new MetaProgramas;
            $metaProgram->id_programa = \Input::get('programa');
            $metaProgram->id_meta = $p->id;
            $metaProgram->save();
        }
        else
        {
            $m = MetaSubProgramas::find($meta_subPrograma->id);
            $m->id_sub_programa = \Input::get('subPrograma');
            $m->save();
        }

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
        $meta_subPrograma = Meta::find($id)->meta_sub_programa($id);
        $meta_Programa = Meta::find($id)->meta_programa($id);

        if (is_object($meta_subPrograma))
        {
            $delete_metaSubprogram = MetaSubProgramas::find($meta_subPrograma->id)->delete();
        }
        if (is_object($meta_Programa))
        {
            $delete_metaSubprogram = MetaProgramas::find($meta_Programa->id)->delete();
        }

        $post = Meta::find($id)->delete();
                return \Redirect::route('plan_desarrollo')
                ->with('alert', 'Registro eliminado con exito!');
	}

}

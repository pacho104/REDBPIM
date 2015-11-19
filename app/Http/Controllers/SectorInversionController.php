<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\SectorInversionRequest;
use App\SectorInversion;
use Illuminate\Http\Request;
use Redirect;

class SectorInversionController extends Controller {

    /**
     * Método contructor que determina que las funciones de la clase SectorInversionController las
     * puede usar un usuario autenticado en el sistema utilizando el middelware auth.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var TYPE_NAME $request */
        $sectorBan = SectorInversion::filtroAndPaginacion($request->get('nom_sector'));
        return view('template.CRUD_sectorInversion.sectorInversion',compact('sectorBan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('template.CRUD_sectorInversion.new_sectorInversion');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SectorInversionRequest $request)
    {
        $sectorBan = new SectorInversion();

        $sectorBan->fill($request->all());
        $sectorBan->nom_sector_inversion = $request->get('nombre_sector');
        $sectorBan->save();

        return Redirect::route('sectorInversion.index')
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
        $sectorBan =  SectorInversion::findOrFail($id);
        return view('template.CRUD_sectorInversion.edit_sectorInversion',compact('sectorBan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RecursoRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(SectorInversionRequest $request, $id)
    {
        $sectorBan = SectorInversion::findOrFail($id);


        $sectorBan->fill($request->all());
        $sectorBan->nom_sector_inversion = $request->get('nombre_sector');
        $sectorBan->save();

        return Redirect::route('sectorInversion.index')
            ->with('alert', 'Registro Actualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

        try {
            $sectorBan = SectorInversion::find($id);
            $sectorBan->delete();
        } catch (PDOException $e) {

            return redirect()->back()->with('ValidationDelete', 'Registro Seleccionado No Fue Eliminado Porqué Esta en Uso');
        }

        return redirect()->back()->with('ValidationDelete', 'Registro Seleccionado Fue Eliminado');
    }

}

<?php namespace App\Http\Controllers;

use App;
use App\FormatoEvidencia;
use App\FormatoEvidenciaPDF;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\FormatoEvidenciaRequest;
use App\Logo;
use App\User;
use Auth;

use DOMPDF;
use File;
use Illuminate\Http\Request;


use Intervention\Image\Facades\Image;
use NumberFormatter;
use Redirect;
use Storage;
use View;


class FormatoEvidenciaController extends Controller {


    /**
     * Método contructor que determina que las funciones de la clase FormatoEvidenciaController las
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
        $formatoEBan = FormatoEvidencia::filtroAndPaginacion($request->get('nom_formato'));
        return view('template.CRUD_formatoEvidencia.formatoEvidencia',compact('formatoEBan'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('template.CRUD_formatoEvidencia.new_formatoEvidencia');
	}

    /**
     * Store a newly created resource in storage.
     * @param FormatoEvidenciaRequest $request
     * @return Response
     */
	public function store(FormatoEvidenciaRequest $request)
    {

            //obtenemos el campo file definido en el formulario
            $file = $request->file('logo');
            $idLogo = 0;

                if($file!=null) {

                    $image = Image::make($file);

                    //cambiar tamaño
                    $image->resize(100, 100);

                    //obtenemos el nombre del archivo
                    $nombre = $file->getClientOriginalName();

                    //url de la ubicacion donde se guardara
                    $public_path = public_path();
                    $url = '/app/logos/' . $nombre;



                            //verificamos si el archivo existe y lo retornamos
                            if (Storage::exists($nombre)) {
                                $logoBD = Logo::filtro($nombre, $url);

                                if ($logoBD->toArray() == null) {
                                    $logoEBan = new Logo();
                                    $logoEBan->nom_logo = $nombre;
                                    $logoEBan->url = $url;
                                    $logoEBan->save();

                                    $logoBD = Logo::filtro($nombre, $url);
                                    $idLogo = $logoBD->toArray()[0]['id'];

                                } else {

                                    $idLogo = $logoBD->toArray()[0]['id'];
                                }

                            } else {

                                        //indicamos que queremos guardar un nuevo archivo en el disco local
                                        // Guardar Original
                                        $image->save($public_path . $url);


                                        $logoBD = Logo::filtro($nombre, $url);

                                        if ($logoBD->toArray() == null) {
                                            $logoEBan = new Logo();
                                            $logoEBan->nom_logo = $nombre;
                                            $logoEBan->url = $url;
                                            $logoEBan->save();

                                            $logoBD = Logo::filtro($nombre, $url);
                                            $idLogo = $logoBD->toArray()[0]['id'];

                                        } else {

                                            $idLogo = $logoBD->toArray()[0]['id'];
                                        }

                            }
                }else{

                    $idLogo=null;
                }

                        $formatoEBan = new FormatoEvidencia();

                        $formatoEBan->fill($request->all());
                        $formatoEBan->nom_formato        = strtoupper($request->get('nombre_formato'));
                        $formatoEBan->encabezado_formato = $request->get('encabezado_formato');
                        $formatoEBan->cuerpo_formato     = $request->get('cuerpo_formato');
                        $formatoEBan->id_logo            = $idLogo;

                        $formatoEBan->save();

                        return Redirect::route('formatoEvidencia.index')
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
        $formatoEBan =  FormatoEvidencia::findOrFail($id);
        $idLogo      =  $formatoEBan->toArray()['id_logo'];
        $url         =  null;

        if($idLogo!=null) {
            $url = $formatoEBan->logo->toArray()['url'];
        }

        return view('template.CRUD_formatoEvidencia.edit_formatoEvidencia',compact('formatoEBan','url'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(FormatoEvidenciaRequest $request,$id)
	{
        $formatoEBan = FormatoEvidencia::findOrFail($id);

        //obtenemos el campo file definido en el formulario
        $file = $request->file('logo');
        $idLogo = 0;

            if($file!=null) {

                            $image = Image::make($file);

                            //cambiar tamaño
                            $image->resize(100, 100);

                            //obtenemos el nombre del archivo
                            $nombre = $file->getClientOriginalName();

                            //url de la ubicacion donde se guardara
                            $public_path = public_path();
                            $url = '/app/logos/' . $nombre;

                            $idLogo = 0;

                            //verificamos si el archivo existe y lo retornamos
                            if (Storage::exists($nombre)) {
                                $logoBD = Logo::filtro($nombre, $url);

                                    if ($logoBD->toArray() == null) {
                                        $logoEBan = new Logo();
                                        $logoEBan->nom_logo = $nombre;
                                        $logoEBan->url = $url;
                                        $logoEBan->save();

                                        $logoBD = Logo::filtro($nombre, $url);
                                        $idLogo = $logoBD->toArray()[0]['id'];

                                    } else {

                                        $idLogo = $logoBD->toArray()[0]['id'];
                                    }

                            } else {

                                    //indicamos que queremos guardar un nuevo archivo en el disco local
                                    // Guardar Original
                                    $image->save($public_path . $url);


                                    $logoBD = Logo::filtro($nombre, $url);

                                    if ($logoBD->toArray() == null) {
                                        $logoEBan = new Logo();
                                        $logoEBan->nom_logo = $nombre;
                                        $logoEBan->url = $url;
                                        $logoEBan->save();

                                        $logoBD = Logo::filtro($nombre, $url);
                                        $idLogo = $logoBD->toArray()[0]['id'];

                                    } else {

                                        $idLogo = $logoBD->toArray()[0]['id'];
                                    }

                            }
            }else{

                $idLogo=$formatoEBan->id_logo;
            }




        $formatoEBan->fill($request->all());
        $formatoEBan->nom_formato        = strtoupper($request->get('nombre_formato'));
        $formatoEBan->encabezado_formato = $request->get('encabezado_formato');
        $formatoEBan->cuerpo_formato     = $request->get('cuerpo_formato');
        $formatoEBan->id_logo            = $idLogo;

        $formatoEBan->save();

        return Redirect::route('formatoEvidencia.index')
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

            $formatoEBan = FormatoEvidencia::find($id);
            $formatoEBan->delete();


        return redirect()->back()->with('ValidationDelete', 'Registro Seleccionado Fue Eliminado');
	}

    /**
     * permite eliminar el logo que tiene el formato
     * @param $id del formato
     */
    public function eliminarLogo($id)
    {
        $formatoEBan = FormatoEvidencia::findOrFail($id);
        $logo        = $formatoEBan->id_logo;

            if($logo!=null){

                $logo=null;
            }

        $formatoEBan->id_logo = $logo;
        $formatoEBan->save();

        return redirect()->back();


    }


    /**
     * Genrera el pdf con la variables que se extraen de los otros modelos
     * @param $id
     * @return mixed
     */
    public function invoice($id)
    {


        $idUser    = Auth::user()->id;
        $user      = User::filtro($idUser);
        $nombreUsu = $user->toArray()[0]['nom_usuario'].' '.$user->toArray()[0]['ape_usuario'];
        $cc        = $user->toArray()[0]['num_identificacion'];
        $nuevaC    = number_format($cc,0,",",".");




        $formatoEBan = FormatoEvidencia::findOrFail($id);
        $nombre      = $formatoEBan->nom_formato;
        $cuerpo      = $formatoEBan->cuerpo_formato;



        $idLogo      = $formatoEBan->id_logo;


        $logo        ='';
        if($idLogo==null){$logo='';}else{$logo= url($formatoEBan->logo->toArray()['url']);}


        $view    = View::make('template.CRUD_formatoEvidencia.formato_pdf', compact('formatoEBan','nombreUsu','nuevaC','cuerpo','logo'))->render();
        $pdf     = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->stream($nombre.'.pdf');
    }



}

<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class FormatoEvidenciaRequest extends Request {

    /**
     * @var Route
     */
    private $route;

    /**
     * @param Route $route
     */
    public function __construct(Route $route){

        $this->route = $route;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'nombre_formato'     => 'required|unique:formato_evidencia,nom_formato,' . $this->route->getParameter('formatoEvidencia'),
            'encabezado_formato' => 'required|:formato_evidencia,encabezado_formato,'. $this->route->getParameter('formatoEvidencia'),
            'cuerpo_formato'     => 'required|:formato_evidencia,cuerpo_formato,'. $this->route->getParameter('formatoEvidencia'),
            'logo'               => 'mimes:jpeg,bmp,png,'. $this->route->getParameter('formatoEvidencia'),

        ];
    }

}

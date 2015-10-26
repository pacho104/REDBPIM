<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class ListaChequeoRequest extends Request {

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
            'nombre_lista' => 'required|unique:lista_chequeo,nom_lista,' . $this->route->getParameter('lista'),
            'tipo' => 'exists:tipo,id',
            'sector' => 'exists:sector_inversion,id',
            'etapa' => 'exists:etapa_lista,id',
            'proceso' => 'exists:proceso,id',
		];
	}

}

<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model {

    protected $table = 'municipio';

    protected $fillable = ['nom_municipio','cod_dane_mun','id_departamento'];

    public $timestamps = false;

    /*
     * Devuelve el municipio por nombre, enviando el nombre por parametro
     */
    public function scopeNombre($query, $name){

        if(trim($name) != "") {

            $query->where('nom_municipio',"LIKE", "%$name%")->orWhere('cod_dane_mun',"LIKE","%$name%");

        }

    }
    /*
     * Devuelve la lista de los municipios que estan registrados
     * */
    public static function  filtroAndPaginacion($name)
    {
       return Municipio::nombre($name)
        ->join('departamento', 'municipio.id_departamento', '=', 'departamento.id')
        ->select('municipio.*', 'departamento.nom_departamento')
        ->orderBy('municipio.id', 'asc')->paginate(8);
    }

    public function planDesarrollo()
    {
        return $this->hasMany('plan_desarrollo');
    }

}

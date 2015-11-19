<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoIdentificacion extends Model {

    protected $table = 'tipo_identificacion';

    protected $fillable = ['nom_identificacion'];

    public $timestamps = false;


    /*
     * Devuelve el tipo de identificacion nombre, enviando el nombre por parametro
     */
    public function scopeNombre($query, $name){

        if(trim($name) != "") {

            $query->where('nom_identificacion',"LIKE", "%$name%");

        }

    }

    /*
      * Devuelve la lista de los departamentos que estan registrados
      * */
    public static function  filtroAndPaginacion($name){

        return TipoIdentificacion::nombre($name)
            ->orderBy('id', 'asc')->paginate(15);
    }

}
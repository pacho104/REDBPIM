<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TiempoSolicitud extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tiempo_solicitud';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','nom_solicitud','tiempo','id_municipio'];


    /**
     * @param $id
     * @return mixed
     */
    public static function filtroAndPaginacion($name,$idMun)
    {

        return TiempoSolicitud::nombre($name,$idMun)->orderBy('id', 'asc')->paginate(15);
    }

    /**
     * Devuelve el El tiempo_Solicitud por id, enviando el id por parametro
     * @param $query
     * @param $name
     * @param $idMun
     * @internal param $id
     */
    public function scopeNombre($query,$name,$idMun)
    {


        $query->where('nom_solicitud',"LIKE","%$name%")->where('id_municipio',"$idMun");


    }

    /**
     * @param $id
     * @return mixed
     */
    public static function filtro($name,$idMun)
    {

        return Solicitud::tiempo($name,$idMun)->orderBy('id', 'asc')->get();
    }

    /**
     * Devuelve el El tiempo_Solicitud por id, enviando el id por parametro
     * @param $query
     * @param $name
     * @param $idMun
     * @internal param $id
     */
    public function scopeTiempo($query,$name,$idMun)
    {


        $query->where('nom_solicitud',"$name")->where('id_municipio',"$idMun");


    }


}

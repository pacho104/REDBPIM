<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisito extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'requisito';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','nom_requisito','obligatorio','municipio_id_municipio'];

    /**
        * Devuelve el requisito por nombre, enviando el nombre por parametro
        */
    public function scopeNombre($query,$name){

        // if(trim($name) != "") {

        $query->where('nom_requisito',"LIKE", "%$name%")->where('municipio_id_municipio',"=",NULL);

        // }
    }

    public static function filtroAndPaginacion($name)
    {

        return Requisito::nombre($name)->orderBy('id', 'asc')->paginate(15);
    }

    /**
     * Devuelve el requisito por nombre, enviando el nombre por parametro
     */
    public function scopeListaMun($query,$name,$idMun){

        // if(trim($name) != "") {

        $query->where('nom_requisito',"LIKE", "%$name%")->where('municipio_id_municipio',"=","$idMun");

        // }
    }
    /**
     * trae todos los requisitos registrados por parte del municipio en la lista de chequeo
     * @param $name
     * @return mixed
     */
    public static function traerReqMun($name,$idMun)    {

        return Requisito::listamun($name,$idMun)->orderBy('id','desc')->get();
    }

    /**
     * trae todos los requisitos registrados por parte del departamento en la lista de chequeo
     * @param $name
     * @return mixed
     */
    public static function traerReq($name)    {

        return Requisito::nombre($name)->orderBy('id','desc')->get();
    }


    /**
     * Devuelve el requisito por nombre, enviando el nombre por parametro
     */
    public function scopeMun($query,$name,$idMun){

        // if(trim($name) != "") {

        $query->where('nom_requisito',"LIKE", "%$name%")->where('municipio_id_municipio',"=","$idMun");

        // }
    }

    public static function filtroAndPaginacionMun($name,$idMun)
    {

        return Requisito::mun($name,$idMun)->orderBy('id', 'asc')->paginate(15);
    }


}

<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'solicitud';



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'nom_solicitud', 'num_solicitud','id_formato_solicitud','id_formato_email','id_usuario','id_municipio'];


    /**
     * @param $id
     * @return mixed
     */
    public static function filtroAndPaginacion($name,$idMun)
    {

        return Solicitud::nombre($name,$idMun)->with('formatoSolicitud','formatoEmail','usuario','municipio')->orderBy('id', 'asc')->paginate(15);
    }

    /**
     * Devuelve el Solicitud por id, enviando el id por parametro
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
     * @param $idMun
     * @return mixed
     * @internal param $id
     */
    public static function ultimoReg($idMun)
    {

        return Solicitud::id($idMun)->with('formatoSolicitud','formatoEmail','usuario','municipio')->get()->last();
    }

    /**
     * @param $query
     * @param $idMun
     */
    public function scopeId($query,$idMun)
    {


        $query->where('id_municipio',"$idMun");


    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function formatoSolicitud(){

        return $this->belongsTo('App\FormatoSolicitud', 'id_formato_solicitud');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function formatoEmail(){

        return $this->belongsTo('App\FormatoEmail', 'id_formato_email');

    }

    /**
 * @return \Illuminate\Database\Eloquent\Relations\HasOne
 */
    public function municipio(){

        return $this->belongsTo('App\Municipio', 'id_municipio');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function usuario(){

        return $this->belongsTo('App\User', 'id_usuario');

    }
}

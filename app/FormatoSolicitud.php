<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FormatoSolicitud extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'formato_solicitud';



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'nom_formato_solicitud', 'cuerpo_formato_solicitud', 'consecutivo_formato_solicitud'];

    public static function filtroAndPaginacion($id)
    {

        return FormatoSolicitud::id($id)->with('solicitud')->orderBy('id', 'asc')->paginate(15);
    }

    /**
     * Devuelve el formatoSolicitud por id, enviando el id por parametro
     * @param $query
     * @param $id
     */
    public function scopeId($query, $id)
    {


        $query->where('id',"$id");


    }

    public function solicitud(){

        return $this->hasOne('App\Solicitud', 'id_formato_solicitud');

    }


    public static function ultimoReg()
    {

        //return FormatoSolicitud::all()->with('solicitud')->get();

    }

}

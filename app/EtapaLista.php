<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class EtapaLista extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'etapa_lista';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','nom_etapa','recurso_id_recurso'];

    /**
     * Devuelve la etapa por nombre, enviando el nombre por parametro
     * @param $query
     * @param $name
     */
    public function scopeNombre($query,$name){

        // if(trim($name) != "") {

        $query->where('nom_etapa',"LIKE", "%$name%");

        // }
    }

    public static function filtroAndPaginacion($name)
    {
        return EtapaLista::nombre($name)->with('recursos')->orderBy('id', 'asc')->paginate(15);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function recursos(){

        return $this->belongsTo('App\Recurso','recurso_id_recurso');

    }

    /**
     * @param $idSala
     * @return los recursos que estan registrados en la la etapa
     */
    public static function recursosRegEtapa($idEtapa)
    {

       return EtapaLista::find($idEtapa)->recursos;

    }
}

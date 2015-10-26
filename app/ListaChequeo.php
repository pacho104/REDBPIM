<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ListaChequeo extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lista_chequeo';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','nom_lista','sector_inversion_id_sector','etapa_lista_id_etapa','proceso_id_proceso'];

    /*
        * Devuelve la lista por nombre, enviando el nombre por parametro
        */
    public function scopeNombre($query,$name){

        // if(trim($name) != "") {

        $query->where('nom_lista',"LIKE", "%$name%")->where('municipio_id_municipio',"=",NULL);

        // }
    }

    public static function filtroAndPaginacion($name)
    {

        return ListaChequeo::nombre($name)->with('sector','etapa.recursos','proceso','tipo')->orderBy('id', 'asc')->paginate(15);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function sector(){

        return $this->belongsTo('App\SectorInversion','sector_inversion_id_sector');

    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function etapa(){

        return $this->belongsTo('App\EtapaLista','etapa_lista_id_etapa');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function proceso(){

        return $this->belongsTo('App\Proceso','proceso_id_proceso');

    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function tipo(){

        return $this->belongsTo('App\Tipo','tipo_lista');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function requisitos(){

        return $this->belongsToMany('App\Requisito','requisito_lista','id_lista_chequeo','id_requisito');

    }
    /**
     * Devuelve el la lista por nombre, enviando el nombre por parametro y el id del municipio
     */
    public function scopeMun($query,$name,$idMun){

        // if(trim($name) != "") {

        $query->where('nom_lista',"LIKE", "%$name%")->where('municipio_id_municipio',"=","$idMun");

        // }
    }

    public static function filtroAndPaginacionMun($name,$idMun)
    {

        return ListaChequeo::mun($name,$idMun)->with('sector','etapa.recursos','proceso','tipo')->orderBy('id', 'asc')->paginate(15);
    }


    /**
     * @param $idLista
     * @return los que requisitos que estan registrados en la lista
     */
    public static function reqLista($idLista,$nomReq){

            if(trim($nomReq) != "") {

                return ListaChequeo::find($idLista)->requisitos()->where('nom_requisito','LIKE',"%$nomReq%")->get();

            }else {

                   return ListaChequeo::find($idLista)->requisitos;
            }

    }


}

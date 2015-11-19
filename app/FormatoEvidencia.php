<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FormatoEvidencia extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'formato_evidencia';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','nom_formato','encabezado_formato','cuerpo_formato','id_logo'];

    /*
     * Devuelve el formatoEvidencia por nombre, enviando el nombre por parametro
     */
    public function scopeNombre($query,$name){

        // if(trim($name) != "") {

        $query->where('nom_formato',"LIKE", "%$name%");

        // }
    }

    public static function filtroAndPaginacion($name)
    {

        return FormatoEvidencia::nombre($name)->with('logo')->orderBy('id', 'asc')->paginate(15);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function logo(){

        return $this->belongsTo('App\Logo','id_logo');

    }
}

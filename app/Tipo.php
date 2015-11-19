<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tipo';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','nom_tipo'];

    /*
     * Devuelve el recurso por nombre, enviando el nombre por parametro
     */
    public function scopeNombre($query,$name){

        // if(trim($name) != "") {

        $query->where('nom_tipo',"LIKE", "%$name%");

        // }
    }

    public static function filtroAndPaginacion($name)
    {

        return Tipo::nombre($name)->orderBy('id', 'asc')->paginate(15);
    }

}

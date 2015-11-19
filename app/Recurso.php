<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'recurso';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','nom_recurso'];

       /*
        * Devuelve el recurso por nombre, enviando el nombre por parametro
        */
    public function scopeNombre($query,$name){

        // if(trim($name) != "") {

        $query->where('nom_recurso',"LIKE", "%$name%");

        // }
    }

    public static function filtroAndPaginacion($name)
    {

        return Recurso::nombre($name)->orderBy('id', 'asc')->paginate(15);
    }


}

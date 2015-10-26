<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Proceso extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'proceso';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','nom_proceso'];

    /*
        * Devuelve el proceso por nombre, enviando el nombre por parametro
        */
    public function scopeNombre($query,$name){

        // if(trim($name) != "") {

        $query->where('nom_proceso',"LIKE", "%$name%");

        // }
    }

    public static function filtroAndPaginacion($name)
    {

        return Proceso::nombre($name)->orderBy('id', 'asc')->paginate(15);
    }


}

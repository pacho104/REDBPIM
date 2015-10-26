<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'estado';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','nom_estado'];

    /*
        * Devuelve el estado por nombre, enviando el nombre por parametro
        */
    public function scopeNombre($query,$name){

       // if(trim($name) != "") {

            $query->where('nom_estado',"LIKE", "%$name%");

       // }
    }

    public static function filtroAndPaginacion($name)
    {

        return Estado::nombre($name)->orderBy('id', 'asc')->paginate(15);
    }

}

<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model {

    protected $table = 'departamento';

    protected $fillable = ['nom_departamento','cod_dane_dep'];

    public $timestamps = false;


    /*
     * Devuelve el departamento por nombre, enviando el nombre por parametro
     */
    public function scopeNombre($query, $name){

        if(trim($name) != "") {

            $query->where('nom_departamento',"LIKE", "%$name%")->orWhere('cod_dane_dep',"LIKE","%$name%");

        }

    }

    public static function filtroAndPaginacion($name)
    {

        return Departamento::nombre($name)->orderBy('id', 'asc')->paginate(15);
    }
}
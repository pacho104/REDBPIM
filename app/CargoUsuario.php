<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CargoUsuario extends Model {

    protected $table = 'cargo_usuario';

    protected $fillable = ['nom_cargo'];

    public $timestamps = false;

    public function scopeNombre($query, $name)
    {
        if(trim($name) != "") {

            $query->where('nom_cargo',"LIKE", "%$name%");

        }

    }
    public static function filtroAndPaginacion($name)
    {
        return CargoUsuario::nombre($name)->orderBy('id', 'asc')->paginate(8);

    }

}
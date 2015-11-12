<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model {

    protected $table = 'tipo_secretaria';

    protected $fillable = ['nombre_secretaria'];

    public $timestamps = false;

    /*
     * Devuelve la secretaria por nombre, enviando el nombre por parametro
     */
    public function scopeNombre($query, $name)
    {
        if(trim($name) != "")
        {
            $query->where('nombre_secretaria',"LIKE", "%$name%");
        }
    }
    /*
     * Devuelve la lista de las secretarias que estan registrados
     * */
    public static function  filtroAndPaginacion($name)
    {
        return Secretaria::nombre($name)
                ->orderBy('id', 'asc')->paginate(8);
    }
}
<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SectorInversion extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sector_inversion';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','nom_sector_inversion'];

    /**
     * Devuelve el sector de inversion por nombre, enviando el nombre por parametro
     */
    public function scopeNombre($query,$name){

        // if(trim($name) != "") {

        $query->where('nom_sector_inversion',"LIKE", "%$name%");

        // }
    }

    public static function filtroAndPaginacion($name)
    {

        return SectorInversion::nombre($name)->orderBy('id', 'asc')->paginate(15);
    }


}

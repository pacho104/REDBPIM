<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'logo';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','nom_logo','url'];

    /*
        * Devuelve el logo por nombre, enviando el nombre por parametro
        */
    public function scopeNombre($query,$name,$url){

        // if(trim($name) != "") {

        $query->where('nom_logo',"=", "$name")->where('url',"=", "$url");

        // }
    }

    public static function filtro($name,$url)
    {

        return Logo::nombre($name,$url)->orderBy('id', 'asc')->get();
    }


}

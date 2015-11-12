<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FormatoEmail extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'formato_email';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'nom_formato', 'asunto', 'cuerpo', 'email_origen', 'email_destino', 'id_municipio'];

    public static function filtroAndPaginacion($name, $id)
    {

        return FormatoEvidencia::nombre($name, $id)->orderBy('id', 'asc')->paginate(15);
    }

    /**
     * Devuelve el formatoEmail por nombre, enviando el nombre por parametro y el id del municipio
     */
    public function scopeNombre($query, $name, $id)
    {

        // if(trim($name) != "") {

        $query->where('nom_formato', "LIKE", "%$name%")->where('id_municipio', "$id");

        // }
    }

}

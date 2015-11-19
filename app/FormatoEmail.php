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
    protected $fillable = ['id', 'nom_formato', 'asunto', 'cuerpo', 'email_origen', 'email_destino'];

    public static function filtroAndPaginacion($id)
    {

        return FormatoEmail::id($id)->orderBy('id', 'asc')->paginate(15);
    }

    /**
     * Devuelve el formatoEmail por id enviando el id por parametro
     */
    public function scopeId($query, $id)
    {


        $query->where('id',"$id");


    }

    public function solicitud()
    {
        return $this->hasOne('App\Solicitud');
    }


}

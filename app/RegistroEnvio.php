<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroEnvio extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'registro_envio';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','created_at','id_formato_email'];


    /**
     * @param $id
     * @return mixed
     */
    public static function filtroAndPaginacion($fecha,$idFormato_email)
    {

        return RegistroEnvio::fecha($fecha,$idFormato_email)->with('formatoEmail')->orderBy('id', 'asc')->paginate(15);
    }

    /**
     * Devuelve el El tiempo_Solicitud por id, enviando el id por parametro
     * @param $query
     * @param $name
     * @param $idMun
     * @internal param $id
     */
    public function scopeFecha($query,$fecha,$idFormato_email)
    {


        $query->where('created_at',"$fecha")->where('id_formato_email',"$idFormato_email");


    }

    public function formatoEmail()
    {
        return $this->hasOne('App\FormatoEmail','id','id_formato_email');
    }


    /**
     * @param $id
     * @return mixed
     */
    public static function filtro($idFormato_email)
    {

        return RegistroEnvio::email($idFormato_email)->with('formatoEmail')->orderBy('id', 'asc')->get();
    }


    /**
     * @param $query
     * @param $idFormato_email
     */
    public function scopeEmail($query,$idFormato_email)
    {


        $query->where('id_formato_email',"$idFormato_email");


    }

}

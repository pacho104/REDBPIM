<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SalasChat extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sala_chat';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','nombre_sala_chat','estado_sala_chat','usuario_id_usuario'];

    /*
     * Devuelve la sala por nombre, enviando el nombre por parametro
     */
    public function scopeNombre($query,$name,$idUsu){

        if(trim($name) != "") {

             $query->where('nombre_sala_chat',"LIKE", "%$name%")->where('usuario_id_usuario','=',"$idUsu");


        }else{

             $query->where('usuario_id_usuario','=',"$idUsu");
        }
    }

    public static function filtroAndPaginacion($name,$idUsu)
    {

            return SalasChat::nombre($idUsu,$name)->orderBy('id', 'asc')->paginate(15);
    }

    public function scopeSalas($query,$estado,$name){

        if(trim($name) != "") {

            $query->where('nombre_sala_chat',"LIKE", "%$name%")->where('estado_sala_chat',"$estado");


        }else{

            $query->where('estado_sala_chat',"$estado");
        }
    }

    /**
     * @param $estado
     * @param $name
     * @return las salas de chat que estan disponibles
     */
    public static function salasDisponibles($estado,$name){

        return SalasChat::salas($estado,$name)->orderBy('id','asc')->paginate(15);
    }

    /**Cambia el estado de la sala de chat
     * @param $id sala
     */
    public static function cambiarDeEstado($id)
    {

        $sala_chat = SalasChat::find($id);


        if($sala_chat->estado_sala_chat==0)
            {
                $sala_chat->estado_sala_chat = 1;

            }
        else
            {
                $sala_chat->estado_sala_chat = 0;
            }

        $sala_chat->save();

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User','usuario_sala','id_sala_chat','id_usuario');
    }

    /**
     * @param $idSala
     * @return los usuarios que estan registrados en la sala
     */
    public static function usuariosRegSala($idSala)
        {
          return SalasChat::find($idSala)->users;
        }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function mensajes(){

        return $this->hasMany('App\Mensaje','id_sala_chat');

    }

    /**
     * @param $idSala
     * @return los mensajes que estan registrados en la sala
     */
    public static function mensajesRegSala($idSala)
    {

        return SalasChat::find($idSala)->mensajes;

    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function usuarios(){

         return $this->belongsToMany('App\User','mensaje','id_sala_chat','id_usuario');
    }

    /**
     * @param $idSala
     * @return los usuarios que enviaron los mensajes que estan registrados en la sala
     */
    public static function usuariosMensajes($idSala)
    {
        $usuariosM = SalasChat::mensajesRegSala($idSala);

        $usuariosMen=SalasChat::find($idSala)->usuarios;

        for($i = 0, $size = count($usuariosM); $i < $size; ++$i) {

            for($j = 0, $size = count($usuariosMen); $j < $size; ++$j) {
                if ($usuariosM[$i]['id_usuario'] == $usuariosMen[$j]['id']) {

                    $usuariosM[$i]['id_usuario']=$usuariosMen[$j]['nom_usuario'].' '.$usuariosMen[$j]['ape_usuario'];
                }
            }
        }

         return $usuariosM;
    }


}

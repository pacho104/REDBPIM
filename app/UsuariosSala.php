<?php namespace App;

use App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsuariosSala extends Model {

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table='usuario_sala';
        public $timestamps = false;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = ['id_sala_chat','id_usuario'];


    /**
     * @param $query
     * @param $idSala
     * @param $idUsu
     */
     public function scopeVerifica($query,$idSala,$idUsu){

                $query->where('id_sala_chat',"$idSala")->where('id_usuario',"$idUsu");
     }

        /**
         * @param $idSala
         * @param $idUsu
         */
        public static function verificar($idSala,$idUsu)
        {
                $validacion=0;

                try {
                        $usuarios_sala = UsuariosSala::verifica($idSala,$idUsu)->orderBy('id','asc')->firstOrFail();

                        $idSalaRe = $usuarios_sala->id_sala_chat;
                        $idUsuRe  = $usuarios_sala->id_usuario;


                        if($idSalaRe==$idSala && $idUsuRe==$idUsu ){

                            $validacion=1;
                        }

                } catch (ModelNotFoundException $e) {

                            $validacion=0;
                }

                return $validacion;

        }

}

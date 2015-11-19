<?php namespace App;

use Illuminate\Database\Eloquent\Model;


class Mensaje extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mensaje';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','texto_mensaje','hora_mensaje','fecha_mensaje','id_sala_chat','id_usuario'];




}

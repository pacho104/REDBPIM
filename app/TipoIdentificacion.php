<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoIdentificacion extends Model {

    protected $table = 'tipo_identificacion';

    protected $fillable = ['nom_identificacion'];

    public $timestamps = false;

}
<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model {

    protected $table = 'tipo_secretaria';

    protected $fillable = ['nombre_secretaria'];

    public $timestamps = false;

}
<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CargoUsuario extends Model {

    protected $table = 'cargo_usuario';

    protected $fillable = ['nom_cargo'];

    public $timestamps = false;

}
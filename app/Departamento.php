<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model {

    protected $table = 'departamento';

    protected $fillable = ['nom_departamento','cod_dane_dep'];

    public $timestamps = false;

}
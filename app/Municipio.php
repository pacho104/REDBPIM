<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model {

    protected $table = 'municipio';

    protected $fillable = ['nom_municipio','cod_dane_mun','id_departamento'];

    public $timestamps = false;

}

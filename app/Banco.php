<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    public $timestamps = false;
    protected $table = 'banco';
    protected $fillable = ['nombre_banco', 'codigo_banco','vigencia_banco','fecha_banco','id_municipio'];
}

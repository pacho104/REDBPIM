<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    public $timestamps = false;
    protected $table = 'programa';
    protected $fillable = ['codigo_programa','nombre_programa','id_eje_estrategico'];

    public function ejeEstrategico()
    {
        return $this->belongsTo('eje_estrategico');
    }

    public function subPrograma()
    {
        return $this->hasMany('sub_programa');
    }

    public function meta()
    {
        return $this->belongsToMany('meta');
    }
}
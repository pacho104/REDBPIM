<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanDesarrollo extends Model
{
    public $timestamps = false;
    protected $table = 'plan_de_desarrollo';
    protected $fillable = ['codigo_plan','nombre_plan','id_municipio'];

    public function municipio()
    {
        return $this->belongsTo('municipio');
    }

    public function ejeEstrategico()
    {
        return $this->hasMany('eje_estrategico');
    }
}
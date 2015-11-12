<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class EjeEstrategico extends Model
{
    public $timestamps = false;
    protected $table = 'eje_estrategico';

    protected $fillable = ['codigo_eje','nombre_eje','id_plan_de_desarrollo'];

    public function planDesarrollo()
    {
        return $this->belongsTo('plan_desarrollo');
    }

    public function Programa()
    {
        return $this->hasMany('programa');
    }
}
<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SubPrograma extends Model
{

    public $timestamps = false;
    protected $table = 'sub_programa';
    protected $fillable = ['codigo_sub_programa','nombre_sub_programa','id_programa'];

    public function meta()
    {
        return $this->belongsToMany('meta');
    }

    public function programa()
    {
        return $this->belongsTo('programa');
    }

}
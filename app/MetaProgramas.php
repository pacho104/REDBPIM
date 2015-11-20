<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MetaProgramas extends Model
{
    public $timestamps = false;
    protected $table = 'meta_programas';
    protected $fillable = ['id_programa','id_meta'];

    public function meta()
    {
        return $this->belongsTo('Meta');
    }


}
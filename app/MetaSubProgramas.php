<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MetaSubProgramas extends Model
{
    public $timestamps = false;
    protected $table = 'meta_subProgramas';
    protected $fillable = ['id_sub_programa','id_meta'];
}
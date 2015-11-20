<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Bibliotecas extends Model
{

    public $timestamps = false;
    protected $table = 'biblioteca';
    protected $fillable = ['titulo_biblioteca', 'documento_biblioteca'];    //

}

<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    public $timestamps = false;
    protected $table = 'meta';

    protected $fillable = ['nombre_meta','tipo_meta','valor_meta'];

    public function meta_programa($id)
    {
        $meta_programa = \DB::table('meta_programas')
                         ->where('id_meta','=', $id)
                         ->first();

        return $meta_programa;
    }

    public function meta_sub_programa($id)
    {
        $meta_subPrograma = \DB::table('meta_subProgramas')
                            ->where('id_meta','=', $id)
                            ->first();

        return $meta_subPrograma;
    }
}
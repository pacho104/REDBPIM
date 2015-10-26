<?php namespace App;


use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword, EntrustUserTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [ 'id','nom_usuario','ape_usuario','num_identificacion', 'tel_usuario',
        'cel_usuario', 'user_login', 'email', 'password', 'estado_user', 'id_municipio',
                            'id_tipo_secretaria','id_tipo_identificacion', 'id_cargo_usuario'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];


    public function scopeNombre($query,$id){


        $query->where('id',"=", "$id");


    }

    public static function filtro($id)
    {

        return User::nombre($id)->with('municipio')->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function municipio(){

        return $this->belongsTo('App\Municipio','id_municipio');

    }

}

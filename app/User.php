<?php namespace App;

use Bican\Roles\Contracts\HasRoleAndPermissionContract as HasRoleAndPermissionContract;
use Bican\Roles\Traits\HasRoleAndPermission;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, HasRoleAndPermissionContract
{

    use Authenticatable, CanResetPassword, HasRoleAndPermission;

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
	protected $fillable = [ 'nom_usuario','ape_usuario','num_identificacion', 'tel_usuario',
        'cel_usuario', 'user_login', 'email', 'password', 'estado_user', 'id_municipio',
                            'id_tipo_secretaria','id_tipo_identificacion', 'id_cargo_usuario'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    public function isAdminGeneral()
    {
        foreach ($this->roles()->get() as $role) {
            if ($role->name == 'Admin') {
                return true;
            }
        }
        return false;
    }

    public function isAdminMunicipal()
    {
        foreach ($this->roles()->get() as $role) {
            if ($role->name == 'AdminMunicipal') {
                return true;
            }
        }
        return false;
    }

}

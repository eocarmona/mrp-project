<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sys_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password', 'user_type_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function scopeSearch($query, $name, $iFilter)
    {
        switch ($iFilter) {
          case \Config::get('scsys.FILTER.ACTIVES'):
            return $query->where('is_deleted', '=', "".\Config::get('scsys.STATUS.ACTIVE'))
                        ->where('username', 'LIKE', "%".$name."%");
            break;

          case \Config::get('scsys.FILTER.DELETED'):
            return $query->where('is_deleted', '=', "".\Config::get('scsys.STATUS.DEL'))
                          ->where('username', 'LIKE', "%".$name."%");
            break;

          case \Config::get('scsys.FILTER.ALL'):
            return $query->where('username', 'LIKE', "%".$name."%");
            break;

          default:
            return $query->where('username', 'LIKE', "%".$name."%");
            break;
        }
    }

    public function userType()
    {
      return $this->belongsTo('App\Sys\TypeUser');
    }

    public function userPermission()
    {
      return $this->hasMany('App\SSys\SUserPermission');
    }
}

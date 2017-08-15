<?php namespace App\SSys;

use Illuminate\Database\Eloquent\Model;

class SUserPermission extends Model
{
  protected $primaryKey = 'id_usr_per';
  protected $table = "sys_user_permissions";
  protected $fillable = ['id_usr_per','user_id','permission_id','privilege_id'];

  public function user()
  {
      return $this->belongsTo('App\User');
  }

  public function privilege()
  {
      return $this->belongsTo('App\SSys\SPrivilege');
  }

  public function permission()
  {
      return $this->belongsTo('App\SSys\SPermission');
  }

  public function scopeSearch($query, $permission_id, $user_id)
  {
      return $query->where('permission_id', '=', "$permission_id")->where('user_id', '=', "$user_id");
  }
}

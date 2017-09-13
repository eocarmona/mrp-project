<?php namespace App\SSys;

use Illuminate\Database\Eloquent\Model;

class SPermission extends Model
{
  protected $connection = 'ssystem';
  protected $primaryKey = 'id_permission';
  protected $table = "syss_permissions";
  protected $fillable = ['id_permission','name', 'code_mrp', 'name', 'is_deleted', 'permission_type_id', 'module_id'];

  public function userPermission()
  {
      return $this->hasMany('App\SSys\SUserPermission');
  }

  public function coUsPermission()
  {
    return $this->hasMany('App\SSys\SCoUsPermission');
  }

  public function module()
  {
      return $this->belongsTo('App\SSys\SModule');
  }

  public function permissionType()
  {
      return $this->belongsTo('App\SSys\SPermissionType');
  }

  public function scopeSearch($query, $name, $iFilter)
    {
      switch ($iFilter) {
        case \Config::get('scsys.FILTER.ACTIVES'):
          return $query->where('is_deleted', '=', "".\Config::get('scsys.STATUS.ACTIVE'))
                      ->where('name', 'LIKE', "%".$name."%");
          break;

        case \Config::get('scsys.FILTER.DELETED'):
          return $query->where('is_deleted', '=', "".\Config::get('scsys.STATUS.DEL'))
                        ->where('name', 'LIKE', "%".$name."%");
          break;

        case \Config::get('scsys.FILTER.ALL'):
          return $query->where('name', 'LIKE', "%".$name."%");
          break;

        default:
          return $query->where('name', 'LIKE', "%".$name."%");
          break;
      }
    }
}

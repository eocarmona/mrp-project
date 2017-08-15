<?php namespace App\SSys;

use Illuminate\Database\Eloquent\Model;

class SPrivilege extends Model
{
  protected $primaryKey = 'id_privilege';
  protected $table = "syss_privileges";
  protected $fillable = ['id_privilege','name'];

  public function userPermission()
  {
      return $this->hasMany('App\SSys\SUserPermission');
  }

  public function scopeSearch($query, $name, $iFilter)
    {
      switch ($iFilter) {
        case \Config::get('constants.FILTER.ACTIVES'):
          return $query->where('is_deleted', '=', "".\Config::get('constants.STATUS.ACTIVE'))
                      ->where('name', 'LIKE', "%".$name."%");
          break;

        case \Config::get('constants.FILTER.DELETED'):
          return $query->where('is_deleted', '=', "".\Config::get('constants.STATUS.DEL'))
                        ->where('name', 'LIKE', "%".$name."%");
          break;

        case \Config::get('constants.FILTER.ALL'):
          return $query->where('name', 'LIKE', "%".$name."%");
          break;

        default:
          return $query->where('name', 'LIKE', "%".$name."%");
          break;
      }
        return $query->where('name', 'LIKE', "%$name%");
    }
}

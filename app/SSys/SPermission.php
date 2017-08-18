<?php namespace App\SSys;

use Illuminate\Database\Eloquent\Model;

class SPermission extends Model
{
  protected $primaryKey = 'id_permission';
  protected $table = "syss_permissions";
  protected $fillable = ['id_permission','name'];

  public function userPermission()
  {
      return $this->hasMany('App\SSys\SUserPermission');
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

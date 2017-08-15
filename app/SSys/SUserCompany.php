<?php namespace App\SSys;

use Illuminate\Database\Eloquent\Model;

class SUserCompany extends Model
{
  protected $primaryKey = 'id_usr_comp';
  protected $table = "sys_user_companies";
  protected $fillable = ['id_usr_comp','user_id','company_id'];

  public function user()
  {
      return $this->belongsTo('App\User');
  }

  public function company()
  {
      return $this->belongsTo('App\SSys\SCompany', 'company_id');
  }

  public function scopeSearch($query, $iFilter)
    {
      switch ($iFilter) {
        case \Config::get('constants.FILTER.ACTIVES'):
          return $query->where('is_deleted', '=', "".\Config::get('constants.STATUS.ACTIVE'));
          break;

        case \Config::get('constants.FILTER.DELETED'):
          return $query->where('is_deleted', '=', "".\Config::get('constants.STATUS.DEL'));
          break;

        case \Config::get('constants.FILTER.ALL'):
          return $query;
          break;

        default:
          return $query;
          break;
      }
  }
}

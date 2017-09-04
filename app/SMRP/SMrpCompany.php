<?php namespace App\SMRP;

use Illuminate\Database\Eloquent\Model;

class SMrpCompany extends Model {

  protected $connection = 'mrp';
  protected $primaryKey = 'id_company';
  protected $table = "mrp_companies";
  protected $fillable = ['id_company', 'name'];

  public function company()
  {
    return $this->hasOne('App\SSys\SCompany');
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

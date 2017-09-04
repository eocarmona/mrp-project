<?php namespace App\SSys;

use Illuminate\Database\Eloquent\Model;

class SCompanyModule extends Model
{
  protected $connection = 'ssystem';
  protected $primaryKey = "id_com_mod";
  protected $table = "syss_company_modules";
  protected $fillable = ['id_com_mod'];

  public function company()
  {
      return $this->belongsTo('App\SSys\SCompany');
  }

  public function module()
  {
      return $this->belongsTo('App\SSys\SModule');
  }
}

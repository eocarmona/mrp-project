<?php namespace App\SSys;

use Illuminate\Database\Eloquent\Model;

class SModule extends Model
{
  protected $primaryKey = 'id_module';
  protected $table = "syss_modules";
  protected $fillable = ['id_module','name'];

  public function companyModule()
  {
      return $this->hasMany('App\SSys\SCompanyModule');
  }

  public function permission()
  {
      return $this->hasMany('App\SSys\SPermission');
  }
}

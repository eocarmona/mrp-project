<?php namespace App\SSys;

use Illuminate\Database\Eloquent\Model;

class SCoUsPermission extends Model
{
  protected $primaryKey = 'id_cup';
  protected $table = "sys_com_usr_prmssns";
  protected $fillable = ['id_cup'];

  public function permission()
  {
      return $this->belongsTo('App\SSys\SPermission');
  }

  public function company()
  {
      return $this->belongsTo('App\SSys\SCompany');
  }

  public function user()
  {
      return $this->belongsTo('App\User');
  }
}

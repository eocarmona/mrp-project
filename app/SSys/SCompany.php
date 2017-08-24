<?php namespace App\SSys;

use Illuminate\Database\Eloquent\Model;

class SCompany extends Model {

    protected $primaryKey = 'id_company';
    protected $table = "sys_companies";
    protected $fillable = ['id_company', 'name', 'database_name', 'host', 'port', 'database_user', 'password', 'default_schema'];

    public function userCompany()
    {
    	return $this->hasMany('App\SSys\SUserCompany');
    }

    public function coUsPermission()
    {
      return $this->hasMany('App\SSys\SCoUsPermission');
    }
}

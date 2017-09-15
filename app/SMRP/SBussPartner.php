<?php namespace App\SMRP;

use Illuminate\Database\Eloquent\Model;

class SBussPartner extends Model {

  protected $connection = 'mrp';
  protected $primaryKey = 'id_bp';
  protected $table = "mrp_buss_partners";

  protected $fillable = [
                          'id_bp',
                          'bp_name',
                          'last_name',
                          'first_name',
                          'id_fiscal',
                          'curp',
                          'web',
                          'siie_id',
                          'is_company',
                          'is_supplier',
                          'is_customer',
                          'is_creditor',
                          'is_debtor',
                          'is_bank',
                          'is_employee',
                          'is_agt_sales',
                          'is_partner',
                          'is_deleted',
                        ];

  public function userCreation()
  {
    return $this->belongsTo('App\User', 'created_by_id');
  }

  public function userUpdate()
  {
    return $this->belongsTo('App\User', 'updated_by_id');
  }

  public function scopeSearch($query, $bpName, $iFilter)
  {
      switch ($iFilter) {
        case \Config::get('scsys.FILTER.ACTIVES'):
          return $query->where('is_deleted', '=', "".\Config::get('scsys.STATUS.ACTIVE'))
                      ->where('bp_name', 'LIKE', "%".$bpName."%");
          break;

        case \Config::get('scsys.FILTER.DELETED'):
          return $query->where('is_deleted', '=', "".\Config::get('scsys.STATUS.DEL'))
                        ->where('bp_name', 'LIKE', "%".$bpName."%");
          break;

        case \Config::get('scsys.FILTER.ALL'):
          return $query->where('bp_name', 'LIKE', "%".$bpName."%");
          break;

        default:
          return $query->where('bp_name', 'LIKE', "%".$bpName."%");
          break;
      }
  }
  
}

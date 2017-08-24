<?php namespace App\SUtils;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\SSys\SUserPermission;
use App\SSys\SUserCompany;
use App\SSys\SCompany;

class SUtil {

  /**
   * Return an UserPermission object with the privileges assigned.
   * If the type user is ADMIN returns an UserPermission object with all the privileges.
   *
   * @param  int  $identifier
   * @param  int  $id_user
   * @return App\SSys\UserPermission
   */
  public static function getTheUserPermission($id_user, $identifier)
  {
      if (\Auth::user()->user_type_id == \Config::get('scsys.TP_USER.ADMIN'))
      {
          $userPermission = new SUserPermission();
          $userPermission->id_usr_per = 0;
          $userPermission->privilege_id = \Config::get('scsys.PRIVILEGES.MANAGER');
          $userPermission->permission_id = $identifier;
          $userPermission->user_id = \Auth::user()->id;
      }
      else
      {
          $userPermission = SUserPermission::where('user_id', $id_user)
                                  ->where('permission_id', $identifier)->first();
      }

      return $userPermission;
  }

  /**
   * Return a list of UserCompany objects corresponding to the user.
   *
   * @param  int  $iUserId
   * @return list of App\SSys\UserCompany
   */
  public static function getUserCompany($oUser)
  {
      $lUserCompany = array();

      if ($oUser->user_type_id == \Config::get('scsys.TP_USER.ADMIN'))
      {
        $lCompanies = SCompany::where('is_deleted', 0)->paginate(10);

        $i = 0;
        foreach ($lCompanies as $oCompany) {
          $oUserCompany = new SUserCompany();
          $oUserCompany->company_id = $oCompany->id_company;
          $lUserCompany[$i] = $oUserCompany;
          $i++;
        }
      }
      else
      {
        $lUserCompany = SUserCompany::where('user_id', '=', $oUser->id)->paginate(10);
      }

      foreach($lUserCompany as $UC) {
        $UC->company;
      }

      return $lUserCompany;
  }

}

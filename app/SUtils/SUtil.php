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
   * @return App\Sys\UserPermission
   */
  public function getTheUserPermission($id_user, $identifier)
  {
      if (\Auth::user()->user_type_id == \Config::get('constants.TP_USER.ADMIN'))
      {
          $userPermission = new SUserPermission();
          $userPermission->id_usr_per = 0;
          $userPermission->privilege_id = \Config::get('constants.PRIVILEGES.MANAGER');
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
   * @return list of App\Sys\UserCompany
   */
  public function getUserCompany($oUser)
  {
      $lUserCompany = array();

      if ($oUser->user_type_id == \Config::get('constants.TP_USER.ADMIN'))
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
        $lUserCompany = SUserCompany::where('user_id', '=', $oUser->id)->where('is_deleted', 0)->paginate(10);
      }

      foreach($lUserCompany as $UC) {
        $UC->company;
      }

      return $lUserCompany;
  }

  /**
   * Determines if ,based on the privilege received, the user is authorized to create
   *
   * @param  int  $iPrivilegeId
   * @return true or false
   */
  public function canCreate($iPrivilegeId)
  {
      return \Config::get('constants.PRIVILEGES.AUTHOR') <= $iPrivilegeId;
  }

  /**
   * Determines if ,based on the privilege received, the user is authorized to edit
   *
   * @param  int  $iPrivilegeId
   * @return true or false
   */
  public function canEdit($iPrivilegeId)
  {
      return \Config::get('constants.PRIVILEGES.EDITOR') <= $iPrivilegeId;
  }

  /**
   * Determines if the user is the author of the registry and if,
   * based on the privilege received, it has the authority to edit
   *
   * @param  int  $iPrivilegeId
   * @return true or false
   */
  public function canAuthorEdit($iPrivilegeId, $iCreatedBy)
  {
      return \Config::get('constants.PRIVILEGES.AUTHOR') == $iPrivilegeId
                  && $iCreatedBy == \Auth::user()->id_user;
  }

  /**
   * Determines if ,based on the privilege received, the user is authorized to destroy
   *
   * @param  int  $iPrivilegeId
   * @return true or false
   */
  public function canDestroy($iPrivilegeId)
  {
      return \Config::get('constants.PRIVILEGES.MANAGER') == $iPrivilegeId;
  }

}

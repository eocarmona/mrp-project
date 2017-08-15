<?php namespace App\SUtils;

class SValidation {

  /**
   * Determines the visibility of the element, based on the privilege received and the element type.
   *
   * @param  int  $iElementType
   * @param  \App\UserPermission $oUserPermission
   * @param  int  $iCreatedBy
   * @return visibility: visible|hidden|collapse|initial|inherit;
   */
  public static function isRendered($iElementType, $oUserPermission, $iCreatedBy)
  {
    # visibility: visible|hidden|collapse|initial|inherit;

    $sRender = 'hidden';

    if (\Auth::user()->user_type_id == \Config::get('constants.TP_USER.ADMIN')) {
      return 'visible';
    }

    switch ($iElementType) {
      case \Config::get('constants.OPERATION.CREATE'): # create
          if ($oUserPermission->privilege_id >= \Config::get('constants.PRIVILEGES.AUTHOR')) {
              $sRender = 'visible';
          }
          break;
      case \Config::get('constants.OPERATION.EDIT'): # edit
          if ($oUserPermission->privilege_id >= \Config::get('constants.PRIVILEGES.EDITOR')) {
              $sRender = 'visible';
          }
          else if ($oUserPermission->privilege_id == \Config::get('constants.PRIVILEGES.AUTHOR') && $iCreatedBy == $oUserPermission->user_id) {
            $sRender = 'visible';
          }
          break;
      case \Config::get('constants.OPERATION.DEL'): #delete
          if ($oUserPermission->privilege_id == \Config::get('constants.PRIVILEGES.MANAGER')) {
            $sRender = 'visible';
          }
          break;
    }

    return $sRender;
  }

  /**
   * Determines if the element is visible based in the visibility attribute.
   *
   * @param  int  $iElementType
   * @param  \App\Assignament $oUserPermission
   * @param  int  $iCreatedBy
   * @return true or false
   */
  public static function isRenderedB($iElementType, $oUserPermission, $iCreatedBy)
  {
      $sRender = SValidation::isRendered($iElementType, $oUserPermission, $iCreatedBy);

      return $sRender == 'visible';
  }

  /**
   * Determines if the element of menú is visible based in the permission.
   *
   * @param  int  $iPermissionId
   * @return 'none' or ''
   */
  public static function showMenu($iPermissionId)
  {
      if (\Auth::user()->user_type_id == \Config::get('constants.TP_USER.ADMIN')) {
        return '';
      }

      foreach (\Auth::user()->userPermission as $oUserPermission) {
          if ($oUserPermission->permission_id == $iPermissionId) {
              return '';
          }
      }

      return 'none';
  }

}

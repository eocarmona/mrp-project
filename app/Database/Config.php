<?php namespace App\Database;

  /**
   *
   */
  class Config {

    public static function getDataBases()
    {
      $lDataBases = array();

      $i = 0;
      $lDataBases[$i++] = 'mrp_cartro';
      $lDataBases[$i++] = 'mrp_aeth';

      return $lDataBases;
    }

    public static function getConnSys()
    {
      return 'ssystem';
    }
  }

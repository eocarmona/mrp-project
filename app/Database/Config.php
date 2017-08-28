<?php namespace App\Database;

  /**
   *
   */
  class Config {

    public static function getDataBases()
    {
      $lDataBases = array();

      $i = 0;
      $lDataBases[$i++] = 'prueba';
      $lDataBases[$i++] = 'prueba1';
      $lDataBases[$i++] = 'prueba2';

      return $lDataBases;
    }
  }

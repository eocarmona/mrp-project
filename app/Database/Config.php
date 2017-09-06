<?php namespace App\Database;

  /**
   *
   */
  class Config {

    /**
     * Return an array with the databases that the system contains.
     * Utilized by the migrations.
     *
     * @return Array with the name of databases.
     */
    public static function getDataBases()
    {
      $lDataBases = array();

      $i = 0;
      $lDataBases[$i++] = 'mrp_cartro';
      $lDataBases[$i++] = 'mrp_aeth';

      return $lDataBases;
    }

    /**
     * Return the connection of the system database.
     *
     * @return String name of connection
     */
    public static function getConnSys()
    {
      return 'ssystem';
    }
  }

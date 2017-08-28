<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Database\OTF;
use App\Database\Config;
use App\SUtils\SUtil;

class MrpAddCataloguesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $databases = Config::getDataBases();

        foreach ($databases as $base) {
          $sConnection = 'company';
          $bDefault = false;
          $sHost = NULL;
          $sDataBase = $base;
          $sUser = NULL;
          $sPassword = NULL;

          SUtil::reconnectDataBase($sConnection, $bDefault, $sHost, $sDataBase, $sUser, $sPassword);

          Schema::connection($sConnection)->create('prueba', function (blueprint $table) {
          	$table->increments('id_prueba');
          });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $databases = Config::getDataBases();

        foreach ($databases as $base) {
          Schema::drop($base);
        }
    }
}

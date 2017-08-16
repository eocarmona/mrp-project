<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('syss_permission_types', function (blueprint $table) {
      	$table->increments('id_type');
      	$table->char('name', 100);
      	$table->boolean('is_deleted');
      });

      DB::table('syss_permission_types')->insert([
      	['id_type' => '1','name' => 'Módulo', 'is_deleted' => '0'],
      	['id_type' => '2','name' => 'Sucursal', 'is_deleted' => '0'],
      	['id_type' => '3','name' => 'Almacén', 'is_deleted' => '0'],
        ['id_type' => '4','name' => 'Vista', 'is_deleted' => '0'],
      ]);

      Schema::create('syss_permissions', function (blueprint $table) {
      	$table->increments('id_permission');
      	$table->char('code', 50);
      	$table->char('name', 100);
      	$table->boolean('is_deleted');
      	$table->integer('type_permission_id')->unsigned();
      	$table->timestamps();

      	$table->foreign('type_permission_id')->references('id_type')->on('syss_permission_types')->onDelete('cascade');
      });

      DB::table('syss_permissions')->insert([
      	['id_permission' => '1','code' => '','name' => 'Módulo Producción', 'is_deleted' => '0','type_permission_id' => '1'],
      	['id_permission' => '2','code' => '','name' => 'Módulo Calidad', 'is_deleted' => '0','type_permission_id' => '1'],
      	['id_permission' => '3','code' => '','name' => 'Módulo Almacenes', 'is_deleted' => '0','type_permission_id' => '1'],
      	['id_permission' => '4','code' => '','name' => 'Módulo Embarques', 'is_deleted' => '0','type_permission_id' => '1'],
      ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('syss_permissions');
      Schema::drop('syss_permission_types');
    }
}

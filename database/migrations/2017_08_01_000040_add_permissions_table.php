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
      	$table->char('code_mrp', 50);
      	$table->char('name', 100);
      	$table->boolean('is_deleted');
      	$table->integer('permission_type_id')->unsigned();
      	$table->integer('module_id')->unsigned();
      	$table->timestamps();

      	$table->foreign('permission_type_id')->references('id_type')->on('syss_permission_types')->onDelete('cascade');
        $table->foreign('module_id')->references('id_module')->on('syss_modules')->onDelete('cascade');
      });

      DB::table('syss_permissions')->insert([
      	['id_permission' => '1','code_mrp' => '1','name' => 'Módulo Producción', 'is_deleted' => '0','permission_type_id' => '1','module_id' => '1'],
      	['id_permission' => '2','code_mrp' => '2','name' => 'Módulo Calidad', 'is_deleted' => '0','permission_type_id' => '1','module_id' => '2'],
      	['id_permission' => '3','code_mrp' => '3','name' => 'Módulo Almacenes', 'is_deleted' => '0','permission_type_id' => '1','module_id' => '3'],
      	['id_permission' => '4','code_mrp' => '4','name' => 'Módulo Embarques', 'is_deleted' => '0','permission_type_id' => '1','module_id' => '4'],
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

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::connection('ssystem')->create('syss_privileges', function (blueprint $table) {
      	$table->increments('id_privilege');
      	$table->char('name', 100);
      	$table->boolean('is_deleted');
      	$table->timestamps();
      });

      DB::table('syss_privileges')->insert([
      	['id_privilege' => '1','name' => 'NO APLICA', 'is_deleted' => '0'],
      	['id_privilege' => '2','name' => 'LECTOR', 'is_deleted' => '0'],
      	['id_privilege' => '3','name' => 'AUTOR', 'is_deleted' => '0'],
      	['id_privilege' => '4','name' => 'EDITOR', 'is_deleted' => '0'],
      	['id_privilege' => '5','name' => 'ADMINISTRADOR', 'is_deleted' => '0'],
      ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('syss_privileges');
    }
}

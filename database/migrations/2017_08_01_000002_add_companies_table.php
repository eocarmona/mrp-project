<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('sys_companies', function (blueprint $table) {
      	$table->increments('id_company');
      	$table->char('name', 100);
      	$table->char('database_name', 100);
      	$table->char('host', 50);
      	$table->char('port', 10);
      	$table->char('database_user', 50);
      	$table->char('password', 150);
      	$table->char('default_schema', 150);
      	$table->boolean('is_deleted');
      	$table->integer('created_by_id')->unsigned();
      	$table->integer('updated_by_id')->unsigned();
      	$table->timestamps();

      	$table->foreign('created_by_id')->references('id')->on('sys_users')->onDelete('cascade');
      	$table->foreign('updated_by_id')->references('id')->on('sys_users')->onDelete('cascade');
      });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('sys_companies');
    }
}

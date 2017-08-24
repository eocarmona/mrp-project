<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsrPerCompnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_usr_per_cmpns', function (blueprint $table) {
        	$table->increments('id_usr_per_comp');
        	$table->integer('user_id')->unsigned();
        	$table->integer('permission_id')->unsigned();
        	$table->integer('company_id')->unsigned();
        	$table->integer('created_by_id')->unsigned();
        	$table->timestamps();

        	$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        	$table->foreign('company_id')->references('id_company')->on('sys_companies')->onDelete('cascade');
        	$table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sys_usr_per_cmpns');
    }
}

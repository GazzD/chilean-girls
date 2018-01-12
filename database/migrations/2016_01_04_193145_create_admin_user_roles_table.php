<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateAdminUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('admin_user_roles', function (Blueprint $table) {
       		// Identifier
    		$table->increments('id');
    		
    		// Fields
    		$table->string('name');
    		$table->boolean('enabled');

    		// Timestamps
    		$table->timestamps();
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('admin_user_roles');
    }
}

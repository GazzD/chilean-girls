<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateAdminUserPasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_user_password_resets', function (Blueprint $table) {
        	// Identifier
    		$table->increments('id');

    		// Fields
    		$table->string('code');
    		$table->dateTime('creation_date');
    		$table->string('creation_ip_address');
    		$table->enum('status', ['EXPIRED','NEW','USED']);
    		$table->dateTime('usage_date');
    		$table->string('usage_ip_address');

    		// Foreign keys
    		$table->integer('admin_user_id')->nullable()->unsigned();
    		$table->foreign('admin_user_id')->references('id')->on('admin_users');

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
        Schema::drop('admin_user_password_resets');
    }
}

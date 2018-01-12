<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            // Identifier
            $table->increments('id');

            // Fields
            $table->string('email');
            $table->boolean('enabled');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('password');
            $table->string('phone');
            
            // Foreign keys
            $table->integer('admin_user_role_id')->nullable()->unsigned();
            $table->foreign('admin_user_role_id')->references('id')->on('admin_user_roles');
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
        Schema::drop('admin_users');
    }
}

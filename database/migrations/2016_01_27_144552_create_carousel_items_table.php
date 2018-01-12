<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateCarouselItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carousel_items', function (Blueprint $table) {
        	// Identifier
    		$table->increments('id');

    		// Fields
    		$table->boolean('enabled');
    		$table->string('image');
    		$table->string('link');
    		$table->string('name');
    		$table->integer('order');
    		$table->string('target');
    		
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
        Schema::drop('carousel_items');
    }
}

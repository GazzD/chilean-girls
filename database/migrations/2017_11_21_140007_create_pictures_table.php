<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pictures', function (Blueprint $table) {
            // Identifier
            $table->increments('id');
            
            // Fields
            $table->boolean('enabled');
            $table->string('image');
            $table->string('name');
            // Foreign keys
            $table->integer('gallery_id')->nullable()->unsigned();
            $table->foreign('gallery_id')->references('id')->on('galleries');
            
            // Timestamp
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
        Schema::dropIfExists('pictures');
    }
}

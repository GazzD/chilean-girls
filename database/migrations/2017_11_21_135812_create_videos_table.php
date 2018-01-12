<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            // Identifier
            $table->increments('id');
            
            // Fields
            $table->boolean('enabled');
            $table->string('name');
            $table->decimal('price');
            $table->string('summary');
            $table->string('video');
            
            // Timestamps
            $table->timestamps();
            
            // Foreign keys
            $table->integer('model_id')->nullable()->unsigned();
            $table->foreign('model_id')->references('id')->on('models');
            $table->integer('category_id')->nullable()->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}

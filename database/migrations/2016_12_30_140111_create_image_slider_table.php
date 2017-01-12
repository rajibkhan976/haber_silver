<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_slider', function (Blueprint $table)
        {
            $table->increments('id');           
            $table->string('title', 45); 
            $table->string('slug', 45);             
            $table->string('caption', 45); 
            $table->string('route', 45); 
            $table->integer('order');
            $table->string('image', 128);
            $table->string('thumb', 128);
            $table->text('short_description', 128);           
            $table->enum('status',array('active','inactive','cancel'))->nullable();
            $table->integer('created_by', false, 11)->nullable();
            $table->integer('updated_by', false, 11)->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('image_slider');
    }
}

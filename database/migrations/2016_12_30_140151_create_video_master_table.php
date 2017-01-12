<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_master', function (Blueprint $table)
        {
            $table->increments('id'); 
            $table->enum('type',array('url','local'));          
            $table->string('title', 45);                        
            $table->string('caption', 45);
            $table->string('caption_image', 128);
            $table->string('caption_thumb', 128); 
            $table->string('video_file', 45);         
            $table->integer('order');
            $table->enum('page_type', array(
                'homepage', 'pages'
            ));
            $table->enum('status',array(
                'active','inactive'
            ))->nullable();
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
       Schema::drop('video_master');
    }
}

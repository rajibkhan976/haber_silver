<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSubCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('product_sub_category', function (Blueprint $table)
        {
            $table->increments('id');            
            $table->unsignedInteger('product_category_id');
            $table->enum('type',array('collection','self'))->nullable();            
            $table->string('title', 45); 
            $table->string('slug', 45);            
            $table->enum('status',array('active','inactive','cancel'))->nullable();
            $table->integer('created_by', false, 11)->nullable();
            $table->integer('updated_by', false, 11)->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

       Schema::table('product_sub_category', function($table) {
            //if 'product_category'  table  exists
            if(Schema::hasTable('product_category'))
            {
                $table->foreign('product_category_id')->references('id')->on('product_category');
            }
         });


       Schema::create('product_sub_cat_image', function (Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('product_sub_cat_id');
            $table->string('image', 128)->nullable();
            $table->string('thumb', 128)->nullable();
            $table->string('alt', 45);
            $table->string('title', 45);  
            $table->enum('status',array('active','inactive','cancel'))->nullable();
            $table->integer('created_by', false, 11)->nullable();
            $table->integer('updated_by', false, 11)->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';

        });

      Schema::table('product_sub_cat_image', function($table) {
            //if 'product_category'  table  exists
            if(Schema::hasTable('product_sub_category'))
            {
                 $table->foreign('product_sub_cat_id')->references('id')->on('product_sub_category');
            }
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_sub_category');
        Schema::drop('product_sub_cat_image');
    }
}

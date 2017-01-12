<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
       Schema::create('product', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('product_code');       
            $table->unsignedInteger('product_category_id');
            $table->unsignedInteger('product_sub_category_id');
            $table->string('title', 45); 
            $table->string('slug', 45); 
            $table->float('cost_price');
            $table->float('sell_price');
            $table->enum('stock_type',array('yes','no'))->nullable();
            $table->integer('quantity')->nullable();
            $table->enum('unit_of_measurement',array('yes','no'))->nullable();
            $table->enum('product_type',array('collection','self'))->nullable();
            $table->enum('status',array('active','inactive','cancel'))->nullable();
            $table->integer('created_by', false, 11)->nullable();
            $table->integer('updated_by', false, 11)->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';

        });

       Schema::table('product', function($table) {
            //if 'product_category'  table  exists
            if(Schema::hasTable('product_category'))
            {
                $table->foreign('product_category_id')->references('id')->on('product_category');
            }

            //if 'product_sub_category'  table  exists
            if(Schema::hasTable('product_sub_category'))
            {
                $table->foreign('product_sub_category_id')->references('id')->on('product_sub_category');
            }
         });


      Schema::create('product_image', function (Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('product_id');
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

      Schema::table('product_image', function($table) {
            //if 'product_category'  table  exists
            if(Schema::hasTable('product'))
            {
               $table->foreign('product_id')->references('id')->on('product');
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
        Schema::drop('product');
        Schema::drop('product_image');
    }
}

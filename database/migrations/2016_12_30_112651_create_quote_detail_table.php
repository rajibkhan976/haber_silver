<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('quote_detail', function (Blueprint $table)
        {
            $table->increments('id');      
            $table->unsignedInteger('quote_head_id');
            $table->unsignedInteger('product_id');
            $table->float('price');
            $table->string('unit_of_measure');
            $table->integer('quantity')->nullable();            
            $table->enum('status',array('active','inactive','cancel'))->nullable();
            $table->integer('created_by', false, 11)->nullable();
            $table->integer('updated_by', false, 11)->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

       Schema::table('quote_detail', function($table) {
            
            //if 'quote_head'  table  exists
            if(Schema::hasTable('quote_head'))
            {
                $table->foreign('quote_head_id')->references('id')->on('quote_head');
            }

            //if 'product'  table  exists
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
        Schema::drop('quote_detail');
    }
}

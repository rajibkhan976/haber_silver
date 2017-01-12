<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmpCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmp_cart', function (Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('users_id');
            $table->string('session_id', 45);
            $table->dateTime('date');
            $table->unsignedInteger('product_id');
            $table->integer('quantity');
            $table->float('price');
            $table->string('unit_of_measure', 45);   
            $table->integer('created_by', false, 11)->nullable();
            $table->integer('updated_by', false, 11)->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Schema::table('tmp_cart', function($table) {
             
            //if 'users'  table  exists
            if(Schema::hasTable('users'))
            {
                $table->foreign('users_id')->references('id')->on('users');
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
        Schema::drop('tmp_cart');
    }
}

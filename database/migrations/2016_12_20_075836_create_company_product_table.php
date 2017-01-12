<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('company_product', function (Blueprint $table)
        {
            $table->increments('id');       
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->enum('status',array('approved','open','close'))->nullable();
            $table->integer('created_by', false, 11)->nullable();
            $table->integer('updated_by', false, 11)->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';

        });

       Schema::table('company_product', function($table) {
            //if 'country'  table  exists
            if(Schema::hasTable('company'))
            {
                $table->foreign('company_id')->references('id')->on('company');
            }

            //if 'users'  table  exists
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
        Schema::drop('company_product');
    }
}

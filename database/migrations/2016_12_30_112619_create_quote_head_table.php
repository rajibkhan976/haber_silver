<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteHeadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_head', function (Blueprint $table)
        {
            $table->increments('id'); 
            $table->string('quote_no', 45); 
            $table->unsignedInteger('users_id');
            $table->unsignedInteger('company_id');
            $table->integer('assinged_to');
            $table->integer('assinged_by');
            $table->dateTime('date');
            $table->float('price');
            $table->float('discount');
            $table->float('vat');
            $table->float('net_price');
            $table->enum('status',array('active','inactive','cancel'))->nullable();
            $table->integer('created_by', false, 11)->nullable();
            $table->integer('updated_by', false, 11)->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';

        });

        Schema::table('quote_head', function($table) {

            //if 'users'  table  exists
            if(Schema::hasTable('users'))
            {
                $table->foreign('users_id')->references('id')->on('users');
            }

            //if 'product'  table  exists
            if(Schema::hasTable('company'))
            {
                $table->foreign('company_id')->references('id')->on('company');
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
        Schema::drop('quote_head');
    }
}


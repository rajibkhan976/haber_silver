<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('customer', function (Blueprint $table)
        {
            $table->increments('id');           
            $table->string('first_name', 32)->nullable();
            $table->string('last_name', 32)->nullable();
            $table->unsignedInteger('company_id')->nullable();
            $table->text('address_one')->nullable();
            $table->text('address_two')->nullable();
            $table->text('address_three')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('country');
            $table->string('phone_number');
            $table->string('fax_number');
            $table->string('email_one', 64)->unique();
            $table->string('email_two', 64)->unique();
            $table->string('email_three', 64)->unique();
            $table->string('email_four', 64)->unique();
            $table->text('notes')->nullable();         
            $table->enum('status',array('active','inactive','cancel'))->nullable(); 
            $table->integer('created_by', false, 11)->nullable();
            $table->integer('updated_by', false, 11)->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';

        });


      Schema::table('customer', function($table) {
            //if 'company'  table  exists
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
        Schema::drop('customer');
    }
}

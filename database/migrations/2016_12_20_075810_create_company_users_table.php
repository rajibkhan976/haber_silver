<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('company_users', function (Blueprint $table)
        {
            $table->increments('id');       
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('users_id')->nullable();
            $table->enum('status',array('active','inactive','cancel'))->nullable();
            $table->integer('created_by', false, 11)->nullable();
            $table->integer('updated_by', false, 11)->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';

        });


        Schema::table('company_users', function($table) {
            //if 'country'  table  exists
            if(Schema::hasTable('company'))
            {
                $table->foreign('company_id')->references('id')->on('company');
            }

            //if 'users'  table  exists
            if(Schema::hasTable('users'))
            {
                $table->foreign('users_id')->references('id')->on('users');
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
        Schema::drop('company_users');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table)
        {
            $table->increments('id');

            $table->string('username', 64)->unique();
            $table->string('email', 64)->unique();
            $table->string('password', 64);

            $table->string('first_name', 32)->nullable();
            $table->string('last_name', 32)->nullable();
            $table->string('image', 128)->nullable();
            $table->string('thumb', 128)->nullable();
            $table->string('auth_key', 128)->nullable();
            $table->string('access_token', 255)->nullable();
            $table->string('ip_address', 16)->nullable();
            $table->dateTime('last_visit')->nullable();

            $table->unsignedInteger('roles_id')->nullable();

            $table->enum('status',array('active','inactive','cancel'))->nullable();

            $table->rememberToken()->nullable();
            $table->integer('created_by',false, 11)->nullable();
            $table->integer('updated_by',false, 11)->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('users', function($table)
        {
            //if 'role'  table  exists
            if(Schema::hasTable('roles') )
            {
                $table->foreign('roles_id')->references('id')->on('roles');
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
        Schema::drop('users');
    }
}

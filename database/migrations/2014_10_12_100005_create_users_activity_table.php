<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*permission_role*/
        Schema::create('users_activity', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('action_name',64)->nullable();
            $table->string('action_url',64)->nullable();
            $table->text('action_detail',64)->nullable();
            $table->string('action_table',64)->nullable();

            $table->unsignedInteger('users_id')->nullable();

            $table->timestamps('created_at');
            $table->engine = 'InnoDB';

        });

        Schema::table('users_activity', function($table) {
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
        Schema::drop('users_activity');
    }
}

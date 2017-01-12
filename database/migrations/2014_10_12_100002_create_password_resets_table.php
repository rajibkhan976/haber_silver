<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('users_id')->nullable();
            $table->string('email', 32)->index();
            $table->string('token', 32)->index();
            $table->dateTime('expire_at')->nullable();
            $table->boolean('status', true);

            $table->timestamp('created_at')->nullable();
            $table->engine = 'InnoDB';

        });
        Schema::table('password_resets', function($table) {
            //if 'User'  table  exists
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
        Schema::drop('password_resets');
    }
}

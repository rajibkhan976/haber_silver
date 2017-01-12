<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*permission_role*/
        Schema::create('roles_permissions', function(Blueprint $table)
        {
            $table->increments('id');

            $table->unsignedInteger('roles_id')->nullable();
            $table->unsignedInteger('permissions_id')->nullable();

            $table->enum('status',array('active','inactive','cancel'))->nullable();

            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Schema::table('roles_permissions', function($table) {
            //if 'permissions'  table  exists
            if(Schema::hasTable('permissions'))
            {
                $table->foreign('permissions_id')->references('id')->on('permissions');
            }
            //if 'roles'  table  exists
            if(Schema::hasTable('roles'))
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
        Schema::drop('roles_permissions');
    }
}

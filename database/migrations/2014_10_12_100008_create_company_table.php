<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('company', function (Blueprint $table)
        {
            $table->increments('id');       
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('approved_product');
            $table->integer('price_level_one');
            $table->integer('price_level_two');
            $table->integer('discount_a');
            $table->integer('discount_b');
            $table->integer('discount_c');
            $table->integer('mark_up_level_one');
            $table->integer('mark_up_level_two');
            $table->integer('mark_up_a');
            $table->integer('mark_up_b');
            $table->integer('mark_up_c');
            $table->string('letter_head_image', 128)->nullable();
            $table->string('letter_head_thumb', 128)->nullable();
            $table->text('letter_head_text')->nullable();
            $table->text('letter_head_footer')->nullable();
            $table->enum('status',array('active','inactive','cancel'))->nullable();
            $table->integer('created_by', false, 11)->nullable();
            $table->integer('updated_by', false, 11)->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('company');
    }
}

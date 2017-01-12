<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotePdfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('quote_pdf', function (Blueprint $table)
        {
            $table->increments('id');      
            $table->unsignedInteger('quote_head_id');
            $table->boolean('is_pdf_generated');         
            $table->string('pdf_path', 45);
            $table->boolean('is_attached_in_email');
            $table->integer('created_by', false, 11)->nullable();
            $table->integer('updated_by', false, 11)->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

       Schema::table('quote_pdf', function($table) {
            
            //if 'quote_head'  table  exists
            if(Schema::hasTable('quote_head'))
            {
                $table->foreign('quote_head_id')->references('id')->on('quote_head');
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
        Schema::drop('quote_pdf');
    }
}

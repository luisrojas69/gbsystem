<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBringCanesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bring_canes', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('sector_id')->unsigned();
            $table->date('date_bring');
            $table->float('value_kg')->nullable()->default(0);
            $table->integer('user_id')->unsigned();
            $table->char('archived',1)->default('N');            
            $table->timestamps();

            $table->foreign('sector_id')->references('id')->on('sectors');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bring_canes');
    }
}

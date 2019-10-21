<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYeildsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yeilds', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('plank_id')->unsigned();
            $table->date('date_yeild');
            $table->float('value_yeild')->nullable()->default(0);
            $table->integer('user_id')->unsigned();
            $table->char('archived',1)->default('N');            
            $table->timestamps();

            $table->foreign('plank_id')->references('id')->on('planks');
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
        Schema::dropIfExists('yeilds');
    }
}

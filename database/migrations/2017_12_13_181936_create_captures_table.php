<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCapturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('captures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plank_id')->unsigned();
            $table->integer('activity_id')->unsigned();
            $table->integer('crop_id')->unsigned();
            $table->integer('variety_id')->unsigned();
            $table->float('area');
            $table->string('comment',100)->nullable();
            $table->date('activity_date');
            $table->timestamps();

            $table->foreign('plank_id')->references('id')->on('planks');
            $table->foreign('activity_id')->references('id')->on('activities');
            $table->foreign('crop_id')->references('id')->on('crops');
            $table->foreign('variety_id')->references('id')->on('varieties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('captures');
    }
}
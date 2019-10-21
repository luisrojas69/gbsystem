<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plank_co',10)->unique();
            $table->string('plank_de',80);
            $table->float('plank_area');
            $table->integer('lot_id')->unsigned();
            $table->timestamps();

            $table->foreign('lot_id')->references('id')->on('lots');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planks');
    }
}

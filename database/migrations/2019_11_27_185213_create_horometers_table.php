<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorometersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horometers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('well_id')->unsigned();
            $table->date('date_read');
            $table->integer('value');
            $table->string('comment',100)->nullable();
            $table->timestamps();

            $table->foreign('well_id')->references('id')->on('wells');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horometers');
    }
}

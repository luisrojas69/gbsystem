<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHarvestCanesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harvest_canes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plank_id')->unsigned();
            $table->date('date_harvest');
            $table->string('harvest_ticket', 20)->nullable();
            $table->string('harvest_remittance', 20)->nullable();
            $table->string('combine_harvester', 20)->nullable();
            $table->string('haulage', 20)->nullable();
            $table->float('value_kg')->nullable()->default(0);
            $table->float('value_yeild')->nullable()->default(0);
            $table->string('vehicle_registration', 20)->nullable();
            $table->string('personal_driver', 20)->nullable();
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
        Schema::dropIfExists('harvest_canes');
    }
}

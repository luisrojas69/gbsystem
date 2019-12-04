<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('animal_cod',5);
            $table->string('animal_na',50);
            $table->string('animal_col',50);
            $table->enum('gender',['f','m'])->default('m')->nullable();
            $table->integer('lot_animal_id')->unsigned();
            $table->integer('breed_id')->unsigned();
            $table->date('date_in');
            $table->float('weight_in');
            $table->enum('condition',['mediania','propia'])->default('propia')->nullable();
            $table->integer('paddock_id')->unsigned();
            $table->integer('rodeo_id')->unsigned();
            $table->string('comment',80)->nullable();
            //$table->integer('sale_id')->unsigned()->nullable();
            //$table->integer('owner_id')->unsigned()->nullable();
            $table->string('image',50);
            $table->timestamps();
            
           // $table->foreign('sale_id')->references('id')->on('sales');
            //$table->foreign('owner_id')->references('id')->on('owners');
            $table->foreign('lot_animal_id')->references('id')->on('lot_animals');
            $table->foreign('breed_id')->references('id')->on('breeds');
            $table->foreign('paddock_id')->references('id')->on('paddocks');
            $table->foreign('rodeo_id')->references('id')->on('rodeos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
}

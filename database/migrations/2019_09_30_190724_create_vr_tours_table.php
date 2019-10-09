<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVrToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vr_tours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('advertise_id')->nullable();
            $table->string('title')->nullable();
            $table->string('path');
            $table->timestamps();
            $table->foreign('advertise_id')->references('id')->on('advertises');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vr_tours');
    }
}

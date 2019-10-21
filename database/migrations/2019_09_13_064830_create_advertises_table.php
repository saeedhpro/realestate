<?php

use App\Advertise;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertises', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('real_estate_id')->default(1);
            $table->unsignedBigInteger('user_id')->default(1);
            $table->unsignedBigInteger('estate_type_id')->default(1);
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('city_id');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('thumbnail')->default('/images/main/no-image.png');
            $table->longText('description')->nullable();
            $table->text('address');
            $table->enum('advertise_type', Advertise::TYPES)->default(Advertise::TYPE_FOR_SELL);
            $table->longText('video')->nullable();
            $table->string('vr_tour')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('want_vr_tour')->default(false);
            $table->unsignedInteger('sell')->nullable();
            $table->unsignedInteger('rent')->nullable();
            $table->float('lat', 11, 9)->nullable();
            $table->float('lng', 11, 9)->nullable();
            $table->unsignedInteger('area')->nullable();
            $table->unsignedInteger('room')->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertises');
    }
}

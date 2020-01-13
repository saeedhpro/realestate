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
            $table->unsignedBigInteger('user_id')->nullable()->default(1);
            $table->unsignedBigInteger('estate_type_id')->default(1);
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('region_id')->nullable();
            $table->string('title');
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('slug')->nullable();
            $table->string('thumbnail')->default(url('/images/main/no-image.png'));
            $table->longText('description')->nullable();
            $table->text('address');
            $table->enum('advertise_type', Advertise::TYPES)->default(Advertise::TYPE_FOR_SELL);
            $table->longText('video')->nullable();
            $table->string('vr_tour_id')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_pro')->default(false);
            $table->boolean('is_escrow')->default(false);
            $table->boolean('want_vr_tour')->default(false);
            $table->boolean('has_elevator')->default(false);
            $table->boolean('has_parking')->default(false);
            $table->integer('unit')->default(1);
            $table->integer('in_floor')->default(1);
            $table->integer('floor')->default(1);
            $table->double('unit_price');
            $table->double('sell')->nullable();
            $table->double('rent')->nullable();
            $table->float('lat', 11, 9)->nullable();
            $table->float('lng', 11, 9)->nullable();
            $table->unsignedInteger('area')->nullable();
            $table->unsignedInteger('room')->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->timestamps();

            $table->foreign('real_estate_id')->references('id')->on('real_estates');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('estate_type_id')->references('id')->on('estate_types');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('region_id')->references('id')->on('regions')->onUpdate('cascade')->onDelete('set null');
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

<?php

use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('name')->nullable();
            $table->enum('type', User::TYPES)->default(User::USER);
            $table->string('address')->nullable();
            $table->string('phone', 13)->nullable();
            $table->string('avatar')->nullable()->default('/images/dashboard/avatar.png');
            $table->unsignedBigInteger('role_id')->default(3);
            $table->unsignedBigInteger('real_estate_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

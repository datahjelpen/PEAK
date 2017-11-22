<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country')->nullable()->default(null);
            $table->string('province')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('zip_code')->nullable()->default(null);
            $table->string('address')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('location_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('location_id');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->unsignedInteger('profile_id')->unique();
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
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
        Schema::dropIfExists('locations');
        Schema::dropIfExists('location_profile');
    }
}

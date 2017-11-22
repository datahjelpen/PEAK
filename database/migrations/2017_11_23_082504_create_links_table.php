<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id');
            $table->string('icon')->nullable()->default(null);
            $table->string('icon_type')->nullable()->default(null);
            $table->string('title_display')->nullable()->default(null);
            $table->string('title_html')->nullable()->default(null);
            $table->string('link')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('link_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('link_id');
            $table->foreign('link_id')->references('id')->on('links')->onDelete('cascade');
            $table->unsignedInteger('profile_id');
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->unique( ['link_id', 'profile_id'] );
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
        Schema::dropIfExists('links');
        Schema::dropIfExists('link_profile');
    }
}

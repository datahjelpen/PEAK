<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('object_types', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name');
            $t->string('slug')->unique();
            $t->unsignedInteger('template')->nullable()->default(null);
            // $t->foreign('template')->references('id')->on('templates');
            $t->timestamps();
        });

        Schema::create('object_statuses', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name');
            $t->string('slug');
            $t->unsignedInteger('object_type');
            $t->foreign('object_type')->references('id')->on('object_types')->onDelete('cascade');
            
            $t->unique( ['slug', 'object_type'] );

            $t->timestamps();
        });

        Schema::create('objects', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name');
            $t->string('slug');
            $t->text('text')->nullable()->default(null);
            $t->text('excerpt')->nullable()->default(null);
            $t->unsignedInteger('object_type');
            $t->foreign('object_type')->references('id')->on('object_types')->onDelete('cascade');
            $t->unsignedInteger('author');
            $t->foreign('author')->references('id')->on('users');
            $t->unsignedInteger('template')->nullable()->default(null);
            // $t->foreign('template')->references('id')->on('templates');
            $t->boolean('comments');
            $t->unsignedInteger('status');
            $t->foreign('status')->references('id')->on('object_statuses');

            $t->unique( ['slug', 'object_type', 'status'] );

            $t->timestamps();
        });

        Schema::create('object_taxonomies', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name');
            $t->string('slug');
            $t->unsignedInteger('object_type');
            $t->foreign('object_type')->references('id')->on('object_types')->onDelete('cascade');
            $t->boolean('hierarchical')->default(true);

            $t->unique( ['slug', 'object_type'] );

            $t->timestamps();
        });

        Schema::create('object_terms', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name');
            $t->string('slug');
            $t->unsignedInteger('parent')->nullable()->default(null);
            $t->unsignedInteger('template')->nullable()->default(null);
            // $t->foreign('template')->references('id')->on('templates');
            $t->unsignedInteger('taxonomy');
            $t->foreign('taxonomy')->references('id')->on('object_taxonomies')->onDelete('cascade');

            $t->unique( ['slug', 'taxonomy'] );

            $t->timestamps();
        });

        Schema::create('object_term_relationships', function (Blueprint $t) {
            $t->increments('id');
            $t->unsignedInteger('object');
            $t->foreign('object')->references('id')->on('objects')->onDelete('cascade');
            $t->unsignedInteger('object_term');
            $t->foreign('object_term')->references('id')->on('object_terms')->onDelete('cascade');

            $t->unique( ['object', 'object_term'] );

            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objects');
        Schema::dropIfExists('object_types');
        Schema::dropIfExists('object_taxonomies');
        Schema::dropIfExists('object_term');
        Schema::dropIfExists('object_term_relationships');
    }
}

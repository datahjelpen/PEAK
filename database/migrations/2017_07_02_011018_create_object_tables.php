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
        Schema::create('objects', function (Blueprint $t) {
            $t->increments('id');
            $t->string('title');
            $t->string('slug')->nullable(false)->change();
            $t->text('text');
            $t->text('excrept');
            $t->integer('object_type')->unsigned();
            $t->foreign('object_type')->references('id')->on('object_types')->onDelete('cascade');
            $t->integer('author')->unsigned();
            $t->foreign('author')->references('id')->on('users');
            $t->integer('template')->unsigned();
            $t->foreign('template')->references('id')->on('templates');
            $t->boolean('comments');
            $t->integer('status')->unsigned();
            $t->foreign('status')->references('id')->on('object_statuses');

            $t->unique( ['slug','object_type'] );

            $t->timestamps();
        });

        Schema::create('object_types', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name');
            $t->string('slug')->unique();
            $t->integer('template');
            $t->foreign('template')->references('id')->on('templates');
            $t->timestamps();
        });

        Schema::create('object_taxonomies', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name');
            $t->string('slug')->nullable(false)->change();
            $t->index('slug');
            $t->integer('object_type')->unsigned();
            $t->foreign('object_type')->references('id')->on('object_types')->onDelete('cascade');
            $t->boolean('hierarchical')->default(true);
            $t->timestamps();
        });

        Schema::create('object_term', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name');
            $t->string('slug')->nullable(false)->change();
            $t->index('slug');
            $t->integer('parent')->default(null);
            $t->integer('template');
            $t->foreign('template')->references('id')->on('templates');
            $t->integer('taxonomy');
            $t->foreign('taxonomy')->references('id')->on('object_taxonomies');

            $t->unique( ['slug','object_type'] );

            $t->timestamps();
        });

        Schema::create('object_term_relationships', function (Blueprint $t) {
            $t->increments('id');
            $t->integer('object')->unsigned();
            $t->foreign('object')->references('id')->on('object_types')->onDelete('cascade');

            $t->integer('object_term')->unsigned();
            $t->foreign('object_term')->references('id')->on('object_types')->onDelete('cascade');
            
            $t->unique( ['object','object_term'] );

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

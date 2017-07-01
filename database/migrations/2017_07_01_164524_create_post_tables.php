<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $t) {
            $t->increments('id');
            $t->string('title');
            $t->string('slug')->nullable(false)->change();
            $t->text('text');
            $t->text('excrept');
            $t->text('extra_css');
            $t->text('extra_js');
            $t->integer('author')->unsigned();
            $t->integer('template')->unsigned();
            $t->integer('microdata')->unsigned();
            $t->integer('custom_meta')->unsigned();
            $t->integer('rights')->unsigned();
            $t->boolean('comments');
            $t->integer('status')->unsigned();

            $t->integer('post_type')->unsigned();
            $t->foreign('post_type')->references('id')->on('post_types')->onDelete('cascade');

            $t->unique( ['slug','post_type'] );

            $t->timestamps();
        });

        Schema::create('post_types', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name');
            $t->string('slug')->unique();
            $t->integer('template');
            $t->integer('rights');
            $t->timestamps();
        });

        Schema::create('post_categories', function (Blueprint $t) {
            $t->string('name');
            $t->string('slug')->nullable(false)->change();
            $t->index('slug');
            $t->string('image');
            $t->integer('parent');
            $t->integer('template');
            $t->integer('rights');

            $t->integer('post_type')->unsigned();
            $t->foreign('post_type')->references('id')->on('post_types')->onDelete('cascade');

            $t->unique( ['slug','post_type'] );

            $t->timestamps();
        });

        Schema::create('post_category_links', function (Blueprint $t) {
            $t->integer('post')->unsigned();
            $t->foreign('post')->references('id')->on('post_types')->onDelete('cascade');

            $t->integer('post_category')->unsigned();
            $t->foreign('post_category')->references('id')->on('post_types')->onDelete('cascade');
            
            $t->unique( ['post','post_category'] );

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
        Schema::dropIfExists('post_types');
    }
}

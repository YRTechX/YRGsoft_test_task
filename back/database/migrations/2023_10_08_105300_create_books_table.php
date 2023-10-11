<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('year_published')->nullable();
            $table->unsignedBigInteger('genre_id')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();
            $table->foreign('author_id')->references('id')->on('authors');
            $table->foreign('genre_id')->references('id')->on('genres');
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
};

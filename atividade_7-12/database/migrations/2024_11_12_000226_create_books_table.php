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
            $table->unsignedBigInteger('category_id'); 
            $table->unsignedBigInteger('publisher_id'); 
            $table->timestamps(); 

            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}

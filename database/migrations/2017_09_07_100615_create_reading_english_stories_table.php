<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadingEnglishStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reading_english_stories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->text('image_cover');
            $table->string('author');
            $table->string('avatar_author')->default('author.png');
            $table->tinyInteger('level')->default(1);
            $table->tinyInteger('genre')->default(1);
            $table->string('length')->default('medium');
            $table->integer('viewed')->default(0);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('reading_english_stories');
    }
}

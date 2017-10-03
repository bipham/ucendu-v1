<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadingChapterOfEnglishStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reading_chapter_of_english_stories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('story_id')->unsigned();
            $table->foreign('story_id')->references('id')->on('reading_english_stories')->onDelete('cascade');
            $table->string('title_chapter');
            $table->integer('images_chapter')->default(0);
            $table->integer('order_chapter');
            $table->text('content_chapter');
            $table->text('audio_link');
//            $table->string('image_feature')->nullable();
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
        Schema::dropIfExists('reading_chapter_of_english_stories');
    }
}

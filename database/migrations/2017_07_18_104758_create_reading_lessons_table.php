<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadingLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reading_lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('level_id')->unsigned();
            $table->foreign('level_id')->references('id')->on('reading_levels')->onDelete('cascade');
            $table->text('content_lesson');
            $table->text('content_highlight');
            $table->string('image_feature')->nullable();
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
        Schema::dropIfExists('reading_lessons');
    }
}

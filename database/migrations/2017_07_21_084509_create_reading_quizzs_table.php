<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadingQuizzsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * type_lesson: 1 - Only 1 type, 2 - Mix Type, 3 - Full Test
     */
    public function up()
    {
        Schema::create('reading_quizzs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lesson_id')->unsigned();
            $table->text('content_quiz');
            $table->text('content_answer_quiz');
            $table->integer('total_questions');
            $table->tinyInteger('type_lesson')->default(1);
            $table->integer('limit_time')->default(0);
            $table->foreign('lesson_id')->references('id')->on('reading_lessons')->onDelete('cascade');
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
        Schema::dropIfExists('reading_quizzs');
    }
}

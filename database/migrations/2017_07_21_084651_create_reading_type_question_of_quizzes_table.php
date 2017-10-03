<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadingTypeQuestionOfQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reading_type_question_of_quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quiz_id')->unsigned();
            $table->integer('type_question_id')->unsigned();
            $table->integer('level_id')->default(1);
            $table->integer('total_questions');
            $table->boolean('status')->default(1);
            $table->foreign('quiz_id')->references('id')->on('reading_quizzs')->onDelete('cascade');
            $table->foreign('type_question_id')->references('id')->on('reading_type_questions')->onDelete('cascade');
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
        Schema::dropIfExists('reading_type_question_of_quizzes');
    }
}

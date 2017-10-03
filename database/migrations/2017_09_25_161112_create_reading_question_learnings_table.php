<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadingQuestionLearningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reading_question_learnings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_question_id')->unsigned();
            $table->integer('level_id')->unsigned();
            $table->integer('question_id_custom')->unsigned();
            $table->string('answer');
            $table->string('keyword')->nullable();
            $table->foreign('level_id')->references('id')->on('reading_levels')->onDelete('cascade');
            $table->foreign('type_question_id')->references('id')->on('reading_type_questions')->onDelete('cascade');
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
        Schema::dropIfExists('reading_question_learnings');
    }
}

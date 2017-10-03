<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadingLearningTypeQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reading_learning_type_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_question_id')->unsigned();
            $table->foreign('type_question_id')->references('id')->on('reading_type_questions')->onDelete('cascade');
            $table->integer('level_id')->unsigned();
            $table->foreign('level_id')->references('id')->on('reading_levels')->onDelete('cascade');
            $table->string('title_section');
            $table->integer('step_section');
            $table->string('icon')->default('fa-cog');
            $table->tinyInteger('view_layout')->default(1);
            $table->text('content_section')->nullable();
            $table->text('left_content')->nullable();
            $table->text('right_content')->nullable();
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
        Schema::dropIfExists('reading_learning_type_questions');
    }
}

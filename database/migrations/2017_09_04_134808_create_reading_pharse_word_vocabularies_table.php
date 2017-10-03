<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadingPharseWordVocabulariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reading_pharse_word_vocabularies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vocabulary_id')->unsigned();
            $table->foreign('vocabulary_id')->references('id')->on('reading_vocabularies')->onDelete('cascade');
            $table->string('phrase_word')->unique();
            $table->text('content')->nullable();
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
        Schema::dropIfExists('reading_pharse_word_vocabularies');
    }
}

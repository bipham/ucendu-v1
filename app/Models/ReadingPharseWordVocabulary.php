<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadingPharseWordVocabulary extends Model
{
    protected $table = 'reading_pharse_word_vocabularies';

    protected $fillable = ['vocabulary_id', 'phrase_word', 'content'];

    public $timestamps = true;

    public function createNewPhraseWord ($vocabulary_id, $phrase_word, $content) {
        $newPhraseWord = new ReadingPharseWordVocabulary();
        $newPhraseWord->vocabulary_id = $vocabulary_id;
        $newPhraseWord->phrase_word = $phrase_word;
        $newPhraseWord->content = $content;
        $newPhraseWord->save();
        return 'success';
    }

    public function getAllPhraseWordByVocabularyId ($vocabulary_id) {
        return $this->where('vocabulary_id', $vocabulary_id)->get();
    }
}

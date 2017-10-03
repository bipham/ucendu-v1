<?php

namespace App\Http\Controllers\Admin;

use App\Models\ReadingVocabulary;
//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReadingPharseWordVocabulary;
use Request;

class ReadingVocabularyController extends Controller
{
    public function getCreateNewVocabulary($domain) {
        $readingVocabularyModel = new ReadingVocabulary();
        $all_vocabularies = $readingVocabularyModel->getAllVocabulary();
//        dd($all_vocabularies);
        return view('admin.readingCreateNewVocabulary', compact('all_vocabularies'));
    }

    public function postCreateNewVocabulary(Request $request)
    {
        if (Request::ajax()) {
            $name_vocabulary = $_POST['name_vocabulary'];
//            $content_type_voca = $_POST['content_type_voca'];
            $name_icon_vocabulary = $_POST['name_icon_vocabulary'];
            if ($name_icon_vocabulary == '') {
                $name_icon_vocabulary = 'fa-star';
            }
            $readingVocabularyModel = new ReadingVocabulary();
            $new_vocabulary_id = $readingVocabularyModel->createNewVocabulary($name_vocabulary, $name_icon_vocabulary);
            return json_encode(['new_vocabulary_id' => $new_vocabulary_id]);
        }
    }

    public function postCreateNewPhraseWord(Request $request)
    {
        if (Request::ajax()) {
            $vocabulary_id = $_POST['vocabulary_id'];
            $name_phrase_word = $_POST['name_phrase_word'];
            $content_phrase_vocabulary = $_POST['content_phrase_vocabulary'];
            $readingPharseWordVocabularyModel = new ReadingPharseWordVocabulary();
            $result = $readingPharseWordVocabularyModel->createNewPhraseWord($vocabulary_id, $name_phrase_word, $content_phrase_vocabulary);
            return json_encode(['result' => $result]);
        }
    }
}

<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReadingVocabulary;
use App\Models\ReadingPharseWordVocabulary;

class ReadingVocabularyController extends Controller
{
    public function getVocabularyReading($domain) {
        $readingVocabularyModel = new ReadingVocabulary();
        $all_vocabularies = $readingVocabularyModel->getAllVocabulary();
//        $readingPharseWordVocabularyModel = new ReadingPharseWordVocabulary();
        return view('client.readingVocabulary', compact('all_vocabularies'));
    }
}

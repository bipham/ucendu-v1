<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReadingChapterOfEnglishStory;
use App\Models\ReadingLevelStory;
use App\Models\ReadingGenreStory;
use App\Models\ReadingEnglishStory;

class EnglishStoryController extends Controller
{
    public function viewStory($domain, $link_story) {
        $story_id = getIdFromLink($link_story);
        $readingEnglishStoryModel = new ReadingEnglishStory();
        $readingChapterOfEnglishStoryModel = new ReadingChapterOfEnglishStory();
        $story = $readingEnglishStoryModel->getStoryById($story_id);
        $chapters = $readingChapterOfEnglishStoryModel->getAllChapterOfStoryByStoryId($story_id);
        $readingLevelStoryModel = new ReadingLevelStory();
        $readingGenreStoryModel = new ReadingGenreStory();
        $level = $readingLevelStoryModel->getLevelById($story->level);
        $genre = $readingGenreStoryModel->getGenreById($story->genre);
//        dd($level);
        return view('client.englishStoryViewDetail', compact('story', 'chapters', 'level', 'genre'));
    }
}

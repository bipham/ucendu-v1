<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReadingChapterOfEnglishStory extends Model
{
    protected $table = 'reading_chapter_of_english_stories';

    protected $fillable = ['story_id', 'title_chapter', 'images_chapter', 'order_chapter', 'content_chapter', 'status'];

    public $timestamps = true;

    public function createNewChapterOfStory ($story_id, $title_chapter, $images_chapter, $order_chapter, $content_chapter) {
        $new_chapter_query = DB::table('reading_chapter_of_english_stories')    -> where('story_id', $story_id)
                                                                                -> where('order_chapter', $order_chapter)
                                                                                -> count();
        if ($new_chapter_query == 0) {
            $newChapterOfStory = new ReadingChapterOfEnglishStory();
            $newChapterOfStory->story_id = $story_id;
            $newChapterOfStory->title_chapter = $title_chapter;
            $newChapterOfStory->images_chapter = $images_chapter;
            $newChapterOfStory->order_chapter = $order_chapter;
            $newChapterOfStory->content_chapter = $content_chapter;
            $newChapterOfStory->save();
            return 'success';
        }
        else {
            return 'fail';
        }

    }

    public function getAllChapterOfStoryByStoryId ($story_id) {
        return $this->where('story_id', $story_id)
                    ->where('status', 1)
                    ->orderBy('order_chapter','asc')
                    ->get();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadingEnglishStory extends Model
{
    protected $table = 'reading_english_stories';

    protected $fillable = ['title', 'image_cover', 'author', 'avatar_author', 'level', 'genre', 'length', 'viewed', 'status'];

    public $timestamps = true;

    public function createNewStory ($title, $image_cover, $author, $avatar_author, $level, $genre, $length) {
        $newStory = new ReadingEnglishStory();
        $newStory->title = $title;
        $newStory->image_cover = $image_cover;
        $newStory->author = $author;
        $newStory->avatar_author = $avatar_author;
        $newStory->level = $level;
        $newStory->genre = $genre;
        $newStory->length = $length;
        $newStory->save();
        return $newStory->id;
    }

    public function getAllEnglishStory () {
        return $this->where('status', 1)
                    ->get();
    }

    public function getStoryById ($id) {
        return $this->where('id',$id)->where('status', 1)->get()->first();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReadingGenreStory extends Model
{
    protected $table = 'reading_genre_stories';

    protected $fillable = ['genre', 'status'];

    public $timestamps = true;

    public function createNewGenreStory($genre) {
        $genre_query = DB::table('reading_genre_stories')   -> where('genre', $genre)
                                                            -> count();
        if ($genre_query == 0) {
            $newGenre = new ReadingGenreStory();
            $newGenre->genre = $genre;
            $newGenre->save();
            return 'success';
        }
        else {
            return 'fail';
        }
    }

    public function getGenreById ($id) {
        return $this->where('id', $id)->pluck('genre')->first();
    }
}

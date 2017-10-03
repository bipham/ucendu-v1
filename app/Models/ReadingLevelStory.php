<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReadingLevelStory extends Model
{
    protected $table = 'reading_level_stories';

    protected $fillable = ['level', 'status'];

    public $timestamps = true;

    public function createNewLevelStory($level) {
        $level_query = DB::table('reading_level_stories')   -> where('level', $level)
                                                            -> count();

        if ($level_query == 0) {
            $newLevel = new ReadingLevelStory();
            $newLevel->level = $level;
            $newLevel->save();
            return 'success';
        }
        else {
            return 'fail';
        }
    }

    public function getLevelById ($id) {
        return $this->where('id', $id)->pluck('level')->first();
    }
}

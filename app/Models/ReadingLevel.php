<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReadingLevel extends Model
{
    protected $table = 'reading_levels';

    protected $fillable = ['level', 'status'];

    public $timestamps = true;

    public function getAllLevel() {
        return $this->where('status', 1)->get();
    }

    public function createNewLevel($level) {
        $level_query = DB::table('reading_levels')   -> where('level', $level)
            -> count();

        if ($level_query == 0) {
            $newLevel = new ReadingLevel();
            $newLevel->level = $level;
            $newLevel->save();
            return 'success';
        }
        else {
            return 'fail';
        }
    }

    public function getLevelById($id) {
        return $this->where('status', 1)
                    ->where('id', $id)
                    ->get()
                    ->first();
    }
}

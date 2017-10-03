<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadingManagerLesson extends Model
{
    protected $table = 'reading_manager_lessons';

    protected $fillable = ['user_id', 'lesson_id', 'status'];

    public $timestamps = true;

    public function  getManagerLessonFromLessonId($lesson_id) {
        return $this->where('lesson_id', $lesson_id)->select('user_id')->get();
    }
}

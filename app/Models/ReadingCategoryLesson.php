<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadingCategoryLesson extends Model
{
    protected $table = 'reading_category_lessons';

    protected $fillable = ['lesson_id', 'cate_id', 'status'];

    public $timestamps = true;

    public function addNewCatePost ($post_id, $cate_id) {
        $newCatePost = new ReadingCategoryLesson();
        $newCatePost->lesson_id = $post_id;
        $newCatePost->cate_id = $cate_id;
        $newCatePost->save();
    }

    public function getCateByLessonId($lesson_id) {
        return $this->where('lesson_id',$lesson_id)->first();
    }
}

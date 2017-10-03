<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReadingLesson extends Model
{
    protected $table = 'reading_lessons';

    protected $fillable = ['title', 'level_id', 'content_lesson', 'content_highlight', 'image_feature', 'status'];

    public $timestamps = true;

    public function createNewPost($title_post, $content_post, $content_highlight, $image_feature) {
        $newReadingLesson = new ReadingLesson();
        $newReadingLesson->title = $title_post;
        $newReadingLesson->content_lesson = $content_post;
        $newReadingLesson->content_highlight = $content_highlight;
        $newReadingLesson->image_feature = $image_feature;
        $newReadingLesson->save();
        return $newReadingLesson->id;
    }

    public function getPracticeNewest($number) {
        return DB::table('reading_lessons')
            ->leftJoin('reading_category_lessons', 'reading_lessons.id', '=', 'reading_category_lessons.lesson_id')
            ->leftJoin('reading_categories', 'reading_categories.id', '=', 'reading_category_lessons.cate_id')
            ->leftJoin('reading_quizzs', 'reading_lessons.id', '=', 'reading_quizzs.lesson_id')
            ->where('reading_quizzs.limit_time', '=', 0)
            ->where('reading_lessons.status', '=', 1)
            ->orderBy('reading_lessons.updated_at','desc')
//            ->take($number)
            ->get();
    }

    public function getTestNewest($number) {
        return DB::table('reading_lessons')
            ->leftJoin('reading_category_lessons', 'reading_lessons.id', '=', 'reading_category_lessons.lesson_id')
            ->leftJoin('reading_categories', 'reading_categories.id', '=', 'reading_category_lessons.cate_id')
            ->leftJoin('reading_quizzs', 'reading_lessons.id', '=', 'reading_quizzs.lesson_id')
            ->where('reading_quizzs.limit_time', '>', 0)
            ->where('reading_lessons.status', '=', 1)
            ->orderBy('reading_lessons.updated_at','desc')
//            ->take($number)
            ->get();
    }

    public function getPracticeNewestOfTypeQuestion($number, $type_question_id) {
        $lessons = DB::table('reading_lessons')
            ->leftJoin('reading_category_lessons', 'reading_lessons.id', '=', 'reading_category_lessons.lesson_id')
            ->leftJoin('reading_categories', 'reading_categories.id', '=', 'reading_category_lessons.cate_id')
            ->leftJoin('reading_quizzs', 'reading_lessons.id', '=', 'reading_quizzs.lesson_id')
            ->leftJoin('reading_type_question_of_quizzes', 'reading_type_question_of_quizzes.quiz_id', '=', 'reading_quizzs.id')
            ->where('reading_quizzs.type_lesson', '=', 1)
            ->where('reading_type_question_of_quizzes.type_question_id', '=', $type_question_id)
            ->where('reading_quizzs.limit_time', '=', 0)
            ->where('reading_lessons.status', '=', 1)
            ->orderBy('reading_lessons.updated_at','desc')
//            ->take($number)
            ->get();
        return $lessons;
    }

     public function getTestNewestOfTypeQuestion($number, $type_question_id) {
         $lessons = DB::table('reading_lessons')
             ->leftJoin('reading_category_lessons', 'reading_lessons.id', '=', 'reading_category_lessons.lesson_id')
             ->leftJoin('reading_categories', 'reading_categories.id', '=', 'reading_category_lessons.cate_id')
             ->leftJoin('reading_quizzs', 'reading_lessons.id', '=', 'reading_quizzs.lesson_id')
             ->leftJoin('reading_type_question_of_quizzes', 'reading_type_question_of_quizzes.quiz_id', '=', 'reading_quizzs.id')
             ->where('reading_quizzs.type_lesson', '=', 1)
             ->where('reading_type_question_of_quizzes.type_question_id', '=', $type_question_id)
             ->where('reading_quizzs.limit_time', '>', 0)
             ->where('reading_lessons.status', '=', 1)
             ->orderBy('reading_lessons.updated_at','desc')
//             ->take($number)
             ->get();
         return $lessons;
     }

    public function getPracticeNewestOfTypeLesson ($number, $type_lesson) {
        $lessons = DB::table('reading_lessons')
            ->leftJoin('reading_category_lessons', 'reading_lessons.id', '=', 'reading_category_lessons.lesson_id')
            ->leftJoin('reading_categories', 'reading_categories.id', '=', 'reading_category_lessons.cate_id')
            ->leftJoin('reading_quizzs', 'reading_lessons.id', '=', 'reading_quizzs.lesson_id')
            ->where('reading_quizzs.type_lesson', '=', $type_lesson)
            ->where('reading_quizzs.limit_time', '=', 0)
            ->where('reading_lessons.status', '=', 1)
            ->orderBy('reading_lessons.updated_at','desc')
//            ->take($number)
            ->get();
        return $lessons;
    }

    public function getTestNewestOfTypeLesson ($number, $type_lesson) {
         $lessons = DB::table('reading_lessons')
             ->leftJoin('reading_category_lessons', 'reading_lessons.id', '=', 'reading_category_lessons.lesson_id')
             ->leftJoin('reading_categories', 'reading_categories.id', '=', 'reading_category_lessons.cate_id')
             ->leftJoin('reading_quizzs', 'reading_lessons.id', '=', 'reading_quizzs.lesson_id')
             ->where('reading_quizzs.type_lesson', '=', $type_lesson)
             ->where('reading_quizzs.limit_time', '>', 0)
             ->where('reading_lessons.status', '=', 1)
             ->orderBy('reading_lessons.updated_at','desc')
//             ->take($number)
             ->get();
         return $lessons;
     }

    public function getLessonById($id) {
        return $this->where('id',$id)->where('status', 1)->get()->first();
    }

    public function getInfoBasicLessonById($id) {
        return $this->where('id',$id)->select('image_feature', 'title')->get()->first();
    }

    public function getLessonByCommentId($cmt_id) {
        return DB::table('reading_question_and_answers')
            ->leftJoin('reading_questions', 'reading_question_and_answers.question_id', '=', 'reading_questions.id')
            ->leftJoin('reading_quizzs', 'reading_questions.quiz_id', '=', 'reading_quizzs.id')
            ->leftJoin('reading_lessons', 'reading_quizzs.lesson_id', '=', 'reading_lessons.id')
            ->where('reading_question_and_answers.id', $cmt_id)
            ->select(['reading_lessons.id', 'reading_lessons.title', 'reading_lessons.image_feature'])
            ->get()
            ->first();
    }

    public function getAllLessons() {
        return $this->where('status',1)->orderBy('updated_at','desc')->select('id', 'title', 'level_id', 'image_feature')->get()->all();
    }

    public function deleteLessonById($id) {
        return DB::table('reading_lessons') ->where('id', $id)
                                            ->update(['status' => 0, 'updated_at' => Carbon::now()]);
    }

    public function updateContentLessonReading($id, $content_lesson, $content_highlight) {
        return DB::table('reading_lessons') ->where('id', $id)
                                            ->update(['content_lesson' => $content_lesson, 'content_highlight' => $content_highlight, 'updated_at' => Carbon::now()]);
    }

    public function updateInfoBasicLessonReading($id, $title, $level_id, $image_feature) {
        return DB::table('reading_lessons') ->where('id', $id)
                                            ->update(['title' => $title, 'level_id' => $level_id, 'image_feature' => $image_feature, 'updated_at' => Carbon::now()]);
    }

    public function updateTitleLessonReading($id, $title, $level_id) {
        return DB::table('reading_lessons') ->where('id', $id)
                                            ->update(['title' => $title, 'level_id' => $level_id, 'updated_at' => Carbon::now()]);
    }

    public function test($level_id) {
        return DB::table('reading_lessons')
            ->leftJoin('reading_quizzs', 'reading_lessons.id', '=', 'reading_quizzs.lesson_id')
            ->leftJoin('reading_type_question_of_quizzes', 'reading_quizzs.id', '=', 'reading_type_question_of_quizzes.quiz_id')
//            ->leftJoin('reading_quizzs', 'reading_lessons.id', '=', 'reading_quizzs.lesson_id')
            ->where('reading_lessons.level_id', $level_id)
            ->where('reading_quizzs.limit_time', 0)
            ->where('reading_quizzs.type_lesson', 1)
            ->where('reading_lessons.status', 1)
//            ->orderBy('reading_lessons.updated_at','desc')
//            ->groupBy('reading_lessons.level_id')
            ->select('reading_lessons.id', 'reading_lessons.title', 'reading_type_question_of_quizzes.type_question_id')
            ->groupBy('reading_type_question_of_quizzes.type_question_id')
            ->get();
    }
}

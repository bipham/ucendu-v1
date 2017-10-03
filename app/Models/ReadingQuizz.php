<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReadingQuizz extends Model
{
    protected $table = 'reading_quizzs';

    protected $fillable = ['lesson_id', 'content_quiz', 'content_answer_quiz', 'total_questions', 'type_lesson', 'limit_time', 'status'];

    public $timestamps = true;

    public function createNewQuiz($post_id, $content_quiz, $content_answer_quiz, $total_questions, $type_lesson, $limit_time) {
        $readingQuizzModel = new ReadingQuizz();
        $readingQuizzModel->lesson_id = $post_id;
        $readingQuizzModel->content_quiz = $content_quiz;
        $readingQuizzModel->content_answer_quiz = $content_answer_quiz;
        $readingQuizzModel->total_questions = $total_questions;
        $readingQuizzModel->type_lesson = $type_lesson;
        $readingQuizzModel->limit_time = $limit_time;
        $readingQuizzModel->save();
        return $readingQuizzModel->id;
    }

    public function getQuizByLessonId($id) {
        return $this->where('lesson_id',$id)->get()->first();
    }

    public function getTotalQuestionByQuizId($quiz_id) {
        $query = $this->where('id',$quiz_id)->get()->pluck('total_questions');
        return $query[0];
    }

    public function updateQuizLessonReading($id, $content_quiz, $content_answer_quiz, $total_questions, $type_lesson, $limit_time) {
        return DB::table('reading_quizzs')  ->where('id', $id)
                                            ->update(['content_quiz' => $content_quiz, 'content_answer_quiz' => $content_answer_quiz, 'total_questions' => $total_questions, 'type_lesson' => $type_lesson, 'limit_time' => $limit_time, 'updated_at' => Carbon::now()]);
    }

    public function getQuizIdByLessonId($id) {
        return $this->where('lesson_id',$id)->select('id')->get()->first();
    }
}

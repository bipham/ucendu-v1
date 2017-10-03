<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReadingQuestion extends Model
{
    protected $table = 'reading_questions';

    protected $fillable = ['quiz_id', 'question_id_custom', 'answer', 'keyword', 'type_question_id', 'status'];

    public $timestamps = true;

    public function addNewQuestion($quiz_id, $question_id_custom, $answer, $keyword, $type_question_id) {
        $question_query = DB::table('reading_questions')    -> where('quiz_id', $quiz_id)
                                                            -> where('question_id_custom', $question_id_custom)
                                                            -> count();

        if ($question_query == 0) {
            $readingQuestionModel = new ReadingQuestion();
            $readingQuestionModel->quiz_id = $quiz_id;
            $readingQuestionModel->question_id_custom = $question_id_custom;
            $readingQuestionModel->answer = $answer;
            $readingQuestionModel->keyword = $keyword;
            $readingQuestionModel->type_question_id = $type_question_id;
            $readingQuestionModel->save();
        }
        else {
            DB::table('reading_questions')  -> where('quiz_id', $quiz_id)
                                            -> where('question_id_custom', $question_id_custom)
                                            -> update(['answer' => $answer, 'keyword' => $keyword, 'type_question_id' => $type_question_id, 'updated_at' => Carbon::now()]);
        }

    }

    public function deleteRowByQuizIdAndQuestionIdCustom($quiz_id, $question_id_custom) {
        $question_query = DB::table('reading_questions')    -> where('quiz_id', $quiz_id)
                                                            -> where('question_id_custom', $question_id_custom)
                                                            -> count();

        if ($question_query != 0) {
            DB::table('reading_questions')  -> where('quiz_id', $quiz_id)
                                            -> where('question_id_custom', $question_id_custom)
                                            -> delete();
        }

        return 'del_success';
    }

    public function checkAnswerByIdCustom($question_id_custom, $answer_key) {
        $answer_extractly = $this->where('question_id_custom',$question_id_custom)->get()->pluck('answer');
        $answer_key = trim($answer_key);
        $answer_solution = trim($answer_extractly[0]);
        if (strpos($answer_solution, '//') !== false) {
            $array_solution = explode("//", $answer_solution);
            foreach ($array_solution as $or_solution) {
                $or_solution = trim($or_solution);
                if (strtolower($or_solution) == strtolower(urldecode($answer_key))) {
                    return true;
                }
            }
        }
        elseif (strtolower($answer_solution) == strtolower(urldecode($answer_key))) {
            return true;
        }
        else return false;
    }

    public function getQuestionIdByIdCustom($question_id_custom) {
        $query = $this->where('question_id_custom',$question_id_custom)->get()->pluck('id');
        return $query[0];
    }

    public function getAllKeywordsByQuestionId($question_id) {
        return $this    ->where('status',1)
                        ->where('id', $question_id)
                        ->get()
                        ->pluck('keyword');
    }

    public function getLessonIdByQuestionId($question_id) {
        return DB::table('reading_questions')
            ->leftJoin('reading_quizzs', 'reading_questions.quiz_id', '=', 'reading_quizzs.id')
            ->where('reading_questions.id', $question_id)
            ->select(['reading_quizzs.lesson_id'])
            ->get()
            ->first();
    }

    public function getQuestionIdCustomById($id) {
        return $this->where('id',$id)->select('question_id_custom')->get()->first();
    }


}

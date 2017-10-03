<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReadingQuestionLearning extends Model
{
    protected $table = 'reading_question_learnings';

    protected $fillable = ['type_question_id', 'level_id', 'question_id_custom', 'answer', 'keyword', 'status'];

    public $timestamps = true;

    public function addNewQuestion($type_question_id, $level_id, $question_id_custom, $answer, $keyword) {
        $question_query = DB::table('reading_question_learnings')    -> where('type_question_id', $type_question_id)
            -> where('level_id', $level_id)
            -> where('question_id_custom', $question_id_custom)
            -> count();

        if ($question_query == 0) {
            $readingQuestionModel = new ReadingQuestionLearning();
            $readingQuestionModel->type_question_id = $type_question_id;
            $readingQuestionModel->level_id = $level_id;
            $readingQuestionModel->question_id_custom = $question_id_custom;
            $readingQuestionModel->answer = $answer;
            $readingQuestionModel->keyword = $keyword;
            $readingQuestionModel->save();
        }
        else {
            DB::table('reading_question_learnings')  -> where('type_question_id', $type_question_id)
                -> where('level_id', $level_id)
                -> where('question_id_custom', $question_id_custom)
                -> update(['answer' => $answer, 'keyword' => $keyword, 'updated_at' => Carbon::now()]);
        }

    }
}

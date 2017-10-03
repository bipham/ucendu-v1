<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReadingResult extends Model
{
    protected $table = 'reading_results';

    protected $fillable = ['user_id', 'quiz_id', 'correct_answer', 'list_answered', 'highest_correct'];

    public $timestamps = true;

    public function saveReadingResultOfUserId($user_id, $quiz_id, $correct_answer, $list_answered, $highest_correct) {
        $result_query = DB::table('reading_results')    -> where('user_id', $user_id)
                                                        -> where('quiz_id', $quiz_id)
                                                        -> count();

        if ($result_query == 0) {
            $newResult = new ReadingResult();
            $newResult->user_id = $user_id;
            $newResult->quiz_id = $quiz_id;
            $newResult->correct_answer = $correct_answer;
            $newResult->list_answered = $list_answered;
            $newResult->highest_correct = $highest_correct;
            $newResult->save();
        }
        else {
            $current_correct = $this-> where('user_id', $user_id)
                                    -> where('quiz_id', $quiz_id)
                                    -> get()
                                    ->pluck('highest_correct');
            if ($highest_correct >= $current_correct[0]) {
                DB::table('reading_results')-> where('user_id', $user_id)
                                            -> where('quiz_id', $quiz_id)
                                            -> update(['correct_answer' => $correct_answer, 'list_answered' => $list_answered, 'highest_correct' => $highest_correct, 'updated_at' => Carbon::now()]);
            }

        }
    }

    public function getResultReadingByUserId($user_id) {
        return DB::table('reading_results')->leftJoin('reading_quizzs', 'reading_results.quiz_id', '=', 'reading_quizzs.id')
                                            -> where('reading_results.user_id', $user_id)
                                            -> select('reading_results.*', 'reading_quizzs.lesson_id')
                                            -> get();

    }
}

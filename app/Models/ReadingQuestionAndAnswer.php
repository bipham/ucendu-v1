<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReadingQuestionAndAnswer extends Model
{
    protected $table = 'reading_question_and_answers';

    protected $fillable = ['question_id', 'user_id', 'reply_id', 'content_cmt', 'status', 'private'];

    public $timestamps = true;

    public function getAllCommentsByQuestionId($question_id) {
        $comments = DB::table('reading_question_and_answers')
            ->rightJoin('users', 'users.id', '=', 'reading_question_and_answers.user_id')
            ->where('reading_question_and_answers.question_id', $question_id)
            ->where('reading_question_and_answers.status', '=', 1)
            ->select(['reading_question_and_answers.*', 'username' => 'users.username', 'avatar' => 'users.avatar'])
            ->orderBy('reading_question_and_answers.updated_at','asc')
            ->get();
        return $comments;
    }

    public function createNewComment($question_id, $user_id, $reply_id, $content_cmt, $private) {
        $newComment = new ReadingQuestionAndAnswer();
        $newComment->question_id = $question_id;
        $newComment->user_id = $user_id;
        $newComment->reply_id = $reply_id;
        $newComment->content_cmt = $content_cmt;
        $newComment->private = $private;
        $newComment->save();
        return $newComment;
    }

    public function getAllRelatedUser($question_id) {
        return DB::table('reading_question_and_answers')
            ->leftJoin('users', 'reading_question_and_answers.user_id', '=', 'users.id')
            ->where('reading_question_and_answers.question_id', $question_id)
            ->where('reading_question_and_answers.status', 1)
            ->where('users.level', 0)
            ->groupBy('reading_question_and_answers.user_id')
            ->select(['reading_question_and_answers.user_id'])
            ->get();
    }

    public function getALlCommentReading() {
        return $this->where('status',1)->orderBy('updated_at','desc')->get()->all();
    }

    public function deleteCommentById($id) {
        return DB::table('reading_question_and_answers')    ->where('id', $id)
                                                            ->update(['status' => 0, 'updated_at' => Carbon::now()]);
    }

    public function setPublicReadingCommentById($id) {
        return DB::table('reading_question_and_answers')    ->where('id', $id)
                                                            ->update(['private' => 0]);
    }

    public function setPrivateReadingCommentById($id) {
        return DB::table('reading_question_and_answers')    ->where('id', $id)
                                                            ->update(['private' => 1]);
    }

    public function getInfoRelateCommentedById($id) {
        return $this->where('id',$id)->select('question_id', 'user_id')->get()->first();
    }
}

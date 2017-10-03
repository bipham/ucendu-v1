<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReadingQuestion;
use App\Models\User;
use App\Models\ReadingQuestionAndAnswer;
use App\Models\ReadingLesson;
use App\Models\ReadingQuizz;
use Request;

class ReadingCommentController extends Controller
{
    public function listCommentReading() {
        $readingQuestionAndAnswerModel = new ReadingQuestionAndAnswer();
        $readingLessonModel = new ReadingLesson();
        $userModel = new User();
        $readingQuizModel = new ReadingQuizz();
        $readingQuestionModel = new ReadingQuestion();

        $all_comments = [];
        $list_comments = $readingQuestionAndAnswerModel->getALlCommentReading();

        if (sizeof($list_comments) != 0) {
            foreach ($list_comments as $index_comment => $comment_reading) {
                $strTimeAgo = timeago($comment_reading->updated_at);
                $array_comment['noti_updated'] = $strTimeAgo;
                $lesson_detail = $readingLessonModel->getLessonByCommentId($comment_reading->id);
                $array_comment['image_lesson_feature'] = $lesson_detail->image_feature;
                $user_detail = $userModel->getInfoBasicUserById($comment_reading->user_id);
                $array_comment['username_cmt'] = $user_detail->username;
                $array_comment['avatar_user'] = $user_detail->avatar;
                $array_comment['lesson_title'] = $lesson_detail->title;
                $array_comment['lesson_id'] = $lesson_detail->id;
                $question_id_commented = $readingQuestionModel->getQuestionIdCustomById($comment_reading->question_id);
                $array_comment['question_id_custom'] = $question_id_commented->question_id_custom;
                $array_comment['question_id'] = $comment_reading->question_id;
                $quiz_id = $readingQuizModel->getQuizIdByLessonId($lesson_detail->id);
                $array_comment['quiz_id'] = $quiz_id->id;
                $array_comment['reply_id'] = $comment_reading->reply_id;
                $array_comment['content_cmt'] = $comment_reading->content_cmt;
                $array_comment['comment_id'] = $comment_reading->id;
                $array_comment['private'] = $comment_reading->private;
                array_push($all_comments, $array_comment);
            }
        }

        return view('admin.readingListComment', compact('all_comments'));
    }

    public function deleteCommentReading($comment_id) {
        if (Request::ajax()) {
            $readingQuestionAndAnswerModel = new ReadingQuestionAndAnswer();
            $result = $readingQuestionAndAnswerModel->deleteCommentById($comment_id);
            return json_encode(['result' => $comment_id]);
        }
    }

    public function setPublicReadingComment($comment_id) {
        if (Request::ajax()) {
            $readingQuestionAndAnswerModel = new ReadingQuestionAndAnswer();
            $result = $readingQuestionAndAnswerModel->setPublicReadingCommentById($comment_id);
            return json_encode(['result' => $comment_id]);
        }
    }

    public function setPrivateReadingComment($comment_id) {
        if (Request::ajax()) {
            $readingQuestionAndAnswerModel = new ReadingQuestionAndAnswer();
            $result = $readingQuestionAndAnswerModel->setPrivateReadingCommentById($comment_id);
            return json_encode(['result' => $comment_id]);
        }
    }

}

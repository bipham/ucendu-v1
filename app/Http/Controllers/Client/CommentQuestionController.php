<?php

namespace App\Http\Controllers\Client;

//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReadingQuestion;
use App\Models\ReadingCommentNotification;
use App\Models\ReadingLesson;
use App\Models\ReadingQuestionAndAnswer;
use App\Models\ReadingManagerLesson;
use App\Models\ReadingQuizz;
use App\Models\User;
use Request;
use Auth;
use LRedis;

class CommentQuestionController extends Controller
{
    public function getComments($domain, $question_id_custom) {
        if (Request::ajax()) {
            $questionModel = new ReadingQuestion();
            $userModel = new User();
            $question_id = $questionModel->getQuestionIdByIdCustom($question_id_custom);
            $commentQuestionModel = new ReadingQuestionAndAnswer();
            $list_comments = $commentQuestionModel->getAllCommentsByQuestionId($question_id);
            foreach ($list_comments as $list_comment) {
                $list_comment->updated_at = timeago($list_comment->updated_at);
            }
            $level_current_user = $userModel->getLevelCurrentUserByUserId(Auth::id());
            return json_encode(['list_comments' => $list_comments, 'user_id' => Auth::id(), 'level_current_user' => $level_current_user->level]);
        }
    }

    public function getKeywords($domain, $question_id_custom) {
        if (Request::ajax()) {
            $questionModel = new ReadingQuestion();
            $question_id = $questionModel->getQuestionIdByIdCustom($question_id_custom);
            $list_keywords = $questionModel->getAllKeywordsByQuestionId($question_id);
            return $list_keywords;
        }
    }

    public function createNewComment($domain)
    {
        if (Request::ajax()) {
            $user_id = $_POST['user_id'];
            $content_cmt = $_POST['content_cmt'];
            $question_id_custom = $_POST['question_id_custom'];
//            $question_id_custom = 39;
            $reply_id = $_POST['reply_id'];
            $readingQuestionModel = new ReadingQuestion();
            $userModel = new User();
            $level_current_user = $userModel->getLevelCurrentUserByUserId(Auth::id());
            if ($level_current_user->level == 0) {
                $privated_cmt = 0;
            }
            else {
                $privated_cmt = 1;
            }
            $question_id = $readingQuestionModel->getQuestionIdByIdCustom($question_id_custom);
            $questionAndAnswerModel = new ReadingQuestionAndAnswer();
            $result = $questionAndAnswerModel->createNewComment($question_id, $user_id, $reply_id, $content_cmt, $privated_cmt);
            $readingCommentNotificationModel = new ReadingCommentNotification();
            $related_users = $questionAndAnswerModel->getAllRelatedUser($question_id);
//            foreach ($related_users as $related_user) {
////                dd($related_user);
//                if ($related_user->user_id != Auth::id()) {
//                    $readingCommentNotificationModel->createNewCommentNotification($question_id, $related_user->user_id);
//                }
//            }

            $readingManagerLessonModel = new ReadingManagerLesson();
            $lesson_id = $readingQuestionModel->getLessonIdByQuestionId($question_id);

            $readingLessonModel = new ReadingLesson();
            $readingQuizzModel = new ReadingQuizz();
            $lesson_detail_basic= $readingLessonModel->getInfoBasicLessonById($lesson_id->lesson_id);


            $user_cmt = $userModel->getInfoBasicUserById(Auth::id());

            $quiz_id = $readingQuizzModel->getQuizIdByLessonId($lesson_id->lesson_id);

            $list_manager_related = $readingManagerLessonModel->getManagerLessonFromLessonId($lesson_id->lesson_id);
            foreach ($list_manager_related as $manager_related) {
//                dd($related_user);
                if ($manager_related->user_id != Auth::id()) {
                    $newNoti = $readingCommentNotificationModel->createNewCommentNotification($result->id, $manager_related->user_id);
                    $totalNoti = $readingCommentNotificationModel->getTotalNumberCommentNotificationNoRead($manager_related->user_id);
                    $redis = LRedis::connection();
                    $redis->publish('commentNotification', json_encode(['user_cmt' => $user_cmt, 'readingLesson' => $lesson_detail_basic, 'quiz_id' => $quiz_id->id, 'lesson_id' => $lesson_id->lesson_id, 'question_id' => $question_id_custom, 'comment_id' => $result->id, 'totalNoti' => $totalNoti, 'user_receive_id' => $manager_related->user_id]));
                }
            }

            $list_admin_related = $userModel->getAllAdmin();
            foreach ($list_admin_related as $admin_detect_related) {
//                dd($related_user);
                if ($admin_detect_related->id != Auth::id()) {
                    $newNoti = $readingCommentNotificationModel->createNewCommentNotification($result->id, $admin_detect_related->id);
                    $totalNoti = $readingCommentNotificationModel->getTotalNumberCommentNotificationNoRead($admin_detect_related->id);
                    $redis = LRedis::connection();
                    $redis->publish('commentNotification', json_encode(['user_cmt' => $user_cmt, 'readingLesson' => $lesson_detail_basic, 'quiz_id' => $quiz_id->id, 'lesson_id' => $lesson_id->lesson_id, 'question_id' => $question_id_custom, 'comment_id' => $result->id, 'totalNoti' => $totalNoti, 'user_receive_id' => $admin_detect_related->id, 'noti_id' => $newNoti->id]));
                }
            }
            return json_encode(['list_comment' => $result]);
        }
    }
}

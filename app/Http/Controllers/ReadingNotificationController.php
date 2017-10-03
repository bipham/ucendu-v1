<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ReadingCommentNotification;
use App\Models\ReadingLesson;
use App\Models\ReadingQuestionAndAnswer;
use App\Models\ReadingQuizz;
use App\Models\ReadingQuestion;
use Request;
use Illuminate\Support\Facades\Auth;

class ReadingNotificationController extends Controller
{
    public function getNotification($user_id) {
        if (Request::ajax()) {
            $readingCommentNotificationModel = new ReadingCommentNotification();
            $readingLessonModel = new ReadingLesson();
            $userModel = new User();
            $readingQuestionAndAnswerModel = new ReadingQuestionAndAnswer();
            $readingQuizzModel = new ReadingQuizz();
            $readingQuestionModel = new ReadingQuestion();

            $result_notifications = [];
            $list_notifications = $readingCommentNotificationModel->getAllNotificationByUserId($user_id);

            if (sizeof($list_notifications) != 0) {
                foreach ($list_notifications as $index_noti => $notificationReading) {
                    $strTimeAgo = timeago($notificationReading->updated_at);
                    $array_notification['noti_updated'] = $strTimeAgo;
                    $array_notification['read'] = $notificationReading->read;
                    $array_notification['type_noti'] = $notificationReading->type_noti;
                    $lesson_detail = $readingLessonModel->getLessonByCommentId($notificationReading->comment_id);
                    $array_notification['lesson_title'] = $lesson_detail->title;
                    $array_notification['image_lesson_feature'] = $lesson_detail->image_feature;
                    $info_related = $readingQuestionAndAnswerModel->getInfoRelateCommentedById($notificationReading->comment_id);
                    $question_id_commented = $readingQuestionModel->getQuestionIdCustomById($info_related->question_id);
                    $user_detail = $userModel->getInfoBasicUserById($info_related->user_id);
                    $array_notification['username_cmt'] = $user_detail->username;
                    $array_notification['avatar_user'] = $user_detail->avatar;
                    $array_notification['question_id'] = $question_id_commented->question_id_custom;
                    $quiz_id = $readingQuizzModel->getQuizIdByLessonId($lesson_detail->id);
                    $array_notification['lesson_id'] = $lesson_detail->id;
                    $array_notification['quiz_id'] = $quiz_id->id;
                    $array_notification['comment_id'] = $notificationReading->comment_id;
                    $array_notification['noti_id'] = $notificationReading->id;
                    array_push($result_notifications, $array_notification);
                }
            }
            return json_encode(['list_notis' => $result_notifications]);
        }
    }

    public function readNotification($type_noti, $id) {
        if (Request::ajax()) {
            $readingCommentNotificationModel = new ReadingCommentNotification();
            if ($type_noti == 0) {
                $type_notification = 'userCommentNotification';
            }
            $result = $readingCommentNotificationModel->readNotificationById($id, $type_notification);
            return json_encode(['ok' => $result]);
        }
    }

    public function markAllNotificationAsRead() {
        if (Request::ajax()) {
            $readingCommentNotificationModel = new ReadingCommentNotification();
            $result = $readingCommentNotificationModel->readAllNotificationByUserId(Auth::id());
            return json_encode(['ok' => $result]);
        }
    }
}

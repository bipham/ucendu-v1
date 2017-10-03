<?php

namespace App\Http\Controllers\Client;

//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReadingQuestion;
use App\Models\ReadingQuizz;
use App\Models\ReadingLesson;
use App\Models\ReadingTypeQuestion;
use App\Models\ReadingTypeQuestionOfQuiz;
use App\Models\ReadingCategoryLesson;
use App\Models\ReadingCategory;
use App\Models\ReadingResult;
use App\Models\ReadingLearningTypeQuestion;
use Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    public function getResultQuiz($domain) {
        if (Request::ajax()) {
            $list_answered = $_GET['list_answer'];
            $quizId = $_GET['quizId'];
            $user_id = Auth::id();
            $correct_answer = [];
            $quizModel = new ReadingQuizz();
            $questionModel = new ReadingQuestion();
            $readingResultModel = new ReadingResult();
            $list_answered_string = '';
            $correct_answer_string = '';
            if ($list_answered != 'emptyList') {
                foreach ($list_answered as $qnumber => $answer_key) {
                    $list_answered_string .= $qnumber . '-' . $answer_key . '|';
                    $isCorrect = $questionModel->checkAnswerByIdCustom($qnumber, $answer_key);
                    if ($isCorrect) {
                        array_push($correct_answer, $qnumber);
                        $correct_answer_string .= $qnumber . '|';
                    }
                }
            }

            $number_correct = sizeof($correct_answer);
            $totalQuestion = $quizModel->getTotalQuestionByQuizId($quizId);
            $saveResult = $readingResultModel->saveReadingResultOfUserId($user_id, $quizId, $correct_answer_string, $list_answered_string, $number_correct);

            return json_encode(['correct_answer' => $correct_answer, 'totalQuestion' => $totalQuestion]);
        }
    }

    public function getSolutionLesson($domain, $lesson_id, $quiz_id) {
//        dd($lesson_id);
        $readingLessonModel = new ReadingLesson();
        $lesson_detail = $readingLessonModel->getLessonById($lesson_id);
        $quizModel = new ReadingQuizz();
        $lesson_quiz = $quizModel->getQuizByLessonId($lesson_id);
        $totalQuestion = $_GET['totalQuestion'];
        $correct_answer = $_GET['correct_answer'];
        $list_answer = $_GET['list_answer'];
        $correct_answer = json_decode($correct_answer);
        $list_answer = json_decode($list_answer);
        $type_lesson = $lesson_quiz->type_lesson;
        $readingTypeQuestionModel = new ReadingTypeQuestion();
        $readingTypeQuestionOfQuizModel = new ReadingTypeQuestionOfQuiz();
        $readingLearningTypeQuestionModel = new ReadingLearningTypeQuestion();
        if ($type_lesson == 1) {
            $type_question_id = $readingTypeQuestionOfQuizModel->getTypeQuestionIdByQuizId($lesson_quiz->id);
            $practice_lessons = $readingLessonModel->getPracticeNewestOfTypeQuestion(8, $type_question_id);
            $test_lessons = $readingLessonModel->getTestNewestOfTypeQuestion(8, $type_question_id);
            $type_question = $readingTypeQuestionModel->getTypeQuestionById($type_question_id);
            $all_learning_sections = $readingLearningTypeQuestionModel->getAllSectionByTypeQuestionId($type_question_id);
        }
        else {
            $practice_lessons = $readingLessonModel->getPracticeNewestOfTypeLesson(8, $type_lesson);
            $test_lessons = $readingLessonModel->getTestNewestOfTypeLesson(8, $type_lesson);
            $type_question = '';
            $all_learning_sections = '';
        }
        $readingCategoryLessonModel = new ReadingCategoryLesson();
        $readingCategoryModel = new ReadingCategory();
        $readingResult = new ReadingResult();
        $result_reading_users = $readingResult->getResultReadingByUserId(Auth::id());
        $highest_result = [];
        foreach ($result_reading_users as $result_reading_user) {
            $highest_result[$result_reading_user->lesson_id] = $result_reading_user->highest_correct;
        }

        return view('client.solutionDetail',compact('lesson_detail', 'lesson_quiz', 'correct_answer', 'totalQuestion', 'list_answer', 'practice_lessons','test_lessons', 'readingCategoryLessonModel', 'readingCategoryModel', 'type_lesson', 'type_question', 'readingTypeQuestionOfQuizModel', 'highest_result', 'all_learning_sections'));
    }

    public function getReadingViewSolutionLesson($domain, $lesson_id, $quiz_id) {
//        dd($lesson_id);
        $readingLessonModel = new ReadingLesson();
        $lesson_detail = $readingLessonModel->getLessonById($lesson_id);
        $quizModel = new ReadingQuizz();
        $lesson_quiz = $quizModel->getQuizByLessonId($lesson_id);
        $type_lesson = $lesson_quiz->type_lesson;
        $readingTypeQuestionModel = new ReadingTypeQuestion();
        $readingTypeQuestionOfQuizModel = new ReadingTypeQuestionOfQuiz();
        $readingLearningTypeQuestionModel = new ReadingLearningTypeQuestion();
        if ($type_lesson == 1) {
            $type_question_id = $readingTypeQuestionOfQuizModel->getTypeQuestionIdByQuizId($lesson_quiz->id);
            $practice_lessons = $readingLessonModel->getPracticeNewestOfTypeQuestion(8, $type_question_id);
            $test_lessons = $readingLessonModel->getTestNewestOfTypeQuestion(8, $type_question_id);
            $type_question = $readingTypeQuestionModel->getTypeQuestionById($type_question_id);
            $all_learning_sections = $readingLearningTypeQuestionModel->getAllSectionByTypeQuestionId($type_question_id);
        }
        else {
            $practice_lessons = $readingLessonModel->getPracticeNewestOfTypeLesson(8, $type_lesson);
            $test_lessons = $readingLessonModel->getTestNewestOfTypeLesson(8, $type_lesson);
            $type_question = '';
            $all_learning_sections = '';
        }
        $readingCategoryLessonModel = new ReadingCategoryLesson();
        $readingCategoryModel = new ReadingCategory();
        $readingResult = new ReadingResult();
        $result_reading_users = $readingResult->getResultReadingByUserId(Auth::id());
        $highest_result = [];
        foreach ($result_reading_users as $result_reading_user) {
            $highest_result[$result_reading_user->lesson_id] = $result_reading_user->highest_correct;
        }
        return view('client.readingOnlyViewSolution',compact('lesson_detail', 'lesson_quiz', 'practice_lessons','test_lessons', 'readingCategoryLessonModel', 'readingCategoryModel', 'type_lesson', 'type_question', 'readingTypeQuestionOfQuizModel', 'highest_result', 'all_learning_sections'));
    }

}

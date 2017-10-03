<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReadingLesson;
use App\Models\ReadingCategoryLesson;
use App\Models\ReadingCategory;
use App\Models\ReadingQuizz;
use App\Models\ReadingTypeQuestion;
use App\Models\ReadingTypeQuestionOfQuiz;
use App\Models\ReadingResult;
use App\Models\ReadingLearningTypeQuestion;
use App\Models\ReadingLevel;
use Illuminate\Support\Facades\Auth;

class ReadingLessonController extends Controller
{
    public function index($domain, $link_level)
    {
        $level_id = getIdFromLink($link_level);
        $lesson_id = 0;
        $readingLevelModel = new ReadingLevel();
        $level = $readingLevelModel->getLevelById($level_id);
        $readingLessonModel = new ReadingLesson();
        $readingTypeQuestionOfQuizModel = new ReadingTypeQuestionOfQuiz();
        $practice_lessons = $readingLessonModel->getPracticeNewest(8);
        $test_lessons = $readingLessonModel->getTestNewest(8);
        $readingResult = new ReadingResult();
        $result_reading_users = $readingResult->getResultReadingByUserId(Auth::id());
        $highest_result = [];
        foreach ($result_reading_users as $result_reading_user) {
            $highest_result[$result_reading_user->lesson_id] = $result_reading_user->highest_correct;
        }
        return view('client.reading',compact('level', 'lesson_id', 'practice_lessons', 'test_lessons', 'readingTypeQuestionOfQuizModel', 'highest_result'));
    }

    public function readingLessonDetail($domain, $level, $link_lesson)
    {
//        dd($link_lesson);
        $lesson_id = getIdFromLink($link_lesson);
        $level_id = getIdFromLink($level);
//        dd($level_id);
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
//        dd($result_reading_users);
        $highest_result = [];
        foreach ($result_reading_users as $result_reading_user) {
            $highest_result[$result_reading_user->lesson_id] = $result_reading_user->highest_correct;
        }
        return view('client.readingLessonDetail',compact('lesson_detail', 'lesson_quiz', 'practice_lessons','test_lessons', 'readingCategoryLessonModel', 'readingCategoryModel', 'type_lesson', 'type_question', 'readingTypeQuestionOfQuizModel', 'highest_result', 'all_learning_sections'));
    }

    public function readingTypeQuestion($domain, $link_type_question)
    {
        $type_question_id = getIdFromLink($link_type_question);
        $readingLessonModel = new ReadingLesson();
        $practice_lessons = $readingLessonModel->getPracticeNewestOfTypeQuestion(8, $type_question_id);
        $test_lessons = $readingLessonModel->getTestNewestOfTypeQuestion(8, $type_question_id);
        $readingTypeQuestionModel = new ReadingTypeQuestion();
        $type_question = $readingTypeQuestionModel->getTypeQuestionById($type_question_id);
        $readingTypeQuestionOfQuizModel = new ReadingTypeQuestionOfQuiz();
        $readingResult = new ReadingResult();
        $result_reading_users = $readingResult->getResultReadingByUserId(Auth::id());
        $highest_result = [];
        foreach ($result_reading_users as $result_reading_user) {
            $highest_result[$result_reading_user->lesson_id] = $result_reading_user->highest_correct;
        }
        $readingLearningTypeQuestionModel = new ReadingLearningTypeQuestion();
        $all_learning_sections = $readingLearningTypeQuestionModel->getAllSectionByTypeQuestionId($type_question_id);
//        dd($all_learning_sections);
        return view('client.readingTypeQuestion',compact('practice_lessons', 'test_lessons', 'type_question', 'readingTypeQuestionOfQuizModel', 'highest_result', 'all_learning_sections'));
    }

    public function readingTypeLesson($domain, $link_type_lesson)
    {
        $type_lesson_id = getIdFromLink($link_type_lesson);
        $readingLessonModel = new ReadingLesson();
        $practice_lessons = $readingLessonModel->getPracticeNewestOfTypeLesson(8, $type_lesson_id);
        $test_lessons = $readingLessonModel->getTestNewestOfTypeLesson(8, $type_lesson_id);
        $readingTypeQuestionOfQuizModel = new ReadingTypeQuestionOfQuiz();
        $readingResult = new ReadingResult();
        $result_reading_users = $readingResult->getResultReadingByUserId(Auth::id());
//        dd($result_reading_users);
        $highest_result = [];
        foreach ($result_reading_users as $result_reading_user) {
            $highest_result[$result_reading_user->lesson_id] = $result_reading_user->highest_correct;
        }
        return view('client.readingTypeLesson',compact('practice_lessons', 'test_lessons', 'type_lesson_id', 'readingTypeQuestionOfQuizModel', 'highest_result'));
    }
}
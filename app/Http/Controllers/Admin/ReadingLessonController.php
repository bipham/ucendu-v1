<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReadingLesson;
use App\Models\ReadingQuestion;
use App\Models\ReadingCategory;
use App\Models\ReadingQuizz;
use App\Models\ReadingCategoryLesson;
use App\Models\ReadingTypeQuestion;
use App\Models\ReadingTypeQuestionOfQuiz;
use App\Models\ReadingLevel;
use DOMDocument;
use Illuminate\Support\Facades\File;
use Request;

class ReadingLessonController extends Controller
{
    public function getUploadReadingLesson() {
        $ques = new ReadingQuestion();
        $i_ques = $ques::orderBy('question_id_custom', 'desc')->first();
        if ($i_ques == NULL) {
            $id_ques = 1;
        }
        else {
            $id_ques = $i_ques->question_id_custom + 1;
        }
        $cate = new ReadingCategory();
        $list_cate = $cate::select()->get();

        $type_quiz = new ReadingTypeQuestion();
        $list_type_quiz = $type_quiz::select()->get();

//        dd($id_ques);
        return view('admin.upPost', compact('id_ques', 'list_cate', 'list_type_quiz'));
    }

    /**
     * @param ClientUpRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUploadReadingLesson(Request $request)
    {
        if (Request::ajax()) {
            $img_url = $_POST['img_url'];
            $img_name = $_POST['img_name'];
            $img_name_no_ext = $_POST['img_name_no_ext'];
            $img_extension = $_POST['img_extension'];
            $img_name = stripUnicode($img_name);
            $content_post = $_POST['content_post'];
            $content_highlight = $_POST['content_highlight'];
            $content_quiz = $_POST['content_quiz'];
            $content_answer_quiz = $_POST['content_answer_quiz'];
            $cate_selected = $_POST['cate_selected'];
            $list_answer = $_POST['list_answer'];
            $title_post = $_POST['title_post'];
            $list_type_questions = $_POST['list_type_questions'];
            $listKeyword = $_POST['listKeyword'];
            $type_lesson = $_POST['type_lesson'];
            $limit_time = $_POST['limit_time'];
            $img_name_no_ext = stripUnicode($img_name_no_ext);
            $img_name_no_ext = str_replace(" ","_", $img_name_no_ext);

            $base_to_php = explode(',', $img_url);
            $data = base64_decode($base_to_php[1]);

            $readingLessonModel = new ReadingLesson();
            $current_lesson_id = $readingLessonModel::orderBy('id', 'desc')->first();

            if ($current_lesson_id == NULL) {
                $current_lesson_id = 1;
            }
            else {
                $current_lesson_id = $current_lesson_id->id + 1;
            }

            $img_name_save = $current_lesson_id . '-' . $img_name_no_ext . '.' . $img_extension;

            $filepath = base_path() . '\storage\upload\images\img-feature';

            if (!File::exists($filepath)) {
                File::makeDirectory($filepath, 0777, true, true);
            }

            $filename_img = base_path() . '\storage\upload\images\img-feature\\' . $img_name_save;

            file_put_contents($filename_img, $data);

            $destination = base_path() . '\storage\upload\images\img-feature\\' . $img_name_save;

            compressImage($filename_img, $destination);

            $post_id = $readingLessonModel->createNewPost($title_post, $content_post, $content_highlight, $img_name_save);

//            $img_feature = new ImageFeature();
//            $img_feature->addImageFeature($post_id, $img_name, $img_url);

            $total_questions = sizeof($list_answer);
            $readingQuizzModel = new ReadingQuizz();
            $quiz_id = $readingQuizzModel->createNewQuiz($post_id, $content_quiz, $content_answer_quiz, $total_questions, $type_lesson, $limit_time);

            $readingCategoryLessonModel = new ReadingCategoryLesson();
            $readingCategoryLessonModel->addNewCatePost($post_id, $cate_selected);

            foreach ($list_answer as $qnumber => $answer) {
                $readingQuestionModel = new ReadingQuestion();
                $readingQuestionModel->addNewQuestion($quiz_id, $qnumber, $answer, $listKeyword[$qnumber], $list_type_questions[$qnumber]);

                $readingTypeQuestionOfQuizModel = new ReadingTypeQuestionOfQuiz();
                $readingTypeQuestionOfQuizModel->addNewQuizQuestion($quiz_id, $list_type_questions[$qnumber]);
            }

            return json_encode(['success' => 'success']);
        }
    }

    public function listReadingLesson() {
        $readingLessonModel = new ReadingLesson();
        $list_lessons = $readingLessonModel->getAllLessons();
        $readingLevelModel = new ReadingLevel();
        $all_levels = $readingLevelModel->getAllLevel();
        return view('admin.readingListLesson', compact('list_lessons', 'all_levels'));
    }

    public function deleteLessonReading($domain, $lesson_id) {
        if (Request::ajax()) {
            $readingLessonModel = new ReadingLesson();
            $result = $readingLessonModel->deleteLessonById($lesson_id);
            return json_encode(['result' => $lesson_id]);
        }
    }

    public function getEditLessonReading($domain, $lesson_id) {
        $ques = new ReadingQuestion();
        $i_ques = $ques::orderBy('id', 'desc')->first();
        if ($i_ques == NULL) {
            $id_ques = 1;
        }
        else {
            $id_ques = $i_ques->question_id_custom + 1;
        }

        $cate = new ReadingCategory();
        $list_cate = $cate::select()->get();

        $type_quiz = new ReadingTypeQuestion();
        $list_type_quiz = $type_quiz::select()->get();

        $readingLessonModel = new ReadingLesson();
        $lesson_detail = $readingLessonModel->getLessonById($lesson_id);
        $quizModel = new ReadingQuizz();
        $lesson_quiz = $quizModel->getQuizByLessonId($lesson_id);
        return view('admin.readingEditLesson',compact('id_ques', 'list_cate', 'list_type_quiz', 'lesson_detail', 'lesson_quiz'));
    }

    public function updateContentLessonReading($domain, $lesson_id) {
        if (Request::ajax()) {
            $content_highlight_lesson = $_POST['content_highlight_lesson'];
            $content_lesson_source = $_POST['content_lesson_source'];
            $readingLessonModel = new ReadingLesson();
            $readingLessonModel->updateContentLessonReading($lesson_id, $content_lesson_source, $content_highlight_lesson);
            return json_encode(['result' => $lesson_id]);
        }
    }

    public function updateQuizReading($domain, $quiz_id) {
        if (Request::ajax()) {
            $content_quiz = $_POST['content_quiz'];
            $content_answer_quiz = $_POST['content_answer_quiz'];
            $lesson_id = $_POST['lesson_id'];
            $list_answer = $_POST['list_answer'];
            $list_type_questions = $_POST['list_type_questions'];
            $list_type_old = $_POST['list_type_old'];
            $list_Q_old = $_POST['list_Q_old'];
            $listKeyword = $_POST['listKeyword'];
            $type_lesson = $_POST['type_lesson'];
            $limit_time = $_POST['limit_time'];

            $readingTypeQuestionOfQuizModel = new ReadingTypeQuestionOfQuiz();
            $readingQuestionModel = new ReadingQuestion();

            $total_questions = sizeof($list_answer);
            $readingQuizzModel = new ReadingQuizz();
            $readingQuizzModel->updateQuizLessonReading($quiz_id, $content_quiz, $content_answer_quiz, $total_questions, $type_lesson, $limit_time);

            if ($type_lesson == 1) {
                if ($list_type_old[0] == '') $list_type_old[0] = 2;
                $readingTypeQuestionOfQuizModel->deleteRowByQuizIdAndTypeQuestionId($quiz_id, $list_type_old[0]);
            }
            else {
                for ($i=0; $i < sizeof($list_type_old); $i++) {
                    if ($list_type_old[$i] == '') $list_type_old[$i] = 2;
                    $readingTypeQuestionOfQuizModel->deleteRowByQuizIdAndTypeQuestionId($quiz_id, $list_type_old[$i]);
                }
            }


            for ($i=0; $i < sizeof($list_Q_old); $i++) {
                $readingQuestionModel->deleteRowByQuizIdAndQuestionIdCustom($quiz_id, $list_Q_old[$i]);
            }

            foreach ($list_answer as $qnumber => $answer) {
                $readingQuestionModel->addNewQuestion($quiz_id, $qnumber, $answer, $listKeyword[$qnumber], $list_type_questions[$qnumber]);
                $readingTypeQuestionOfQuizModel->addNewQuizQuestion($quiz_id, $list_type_questions[$qnumber]);
            }

            return json_encode(['result' => $lesson_id]);
        }
    }

    public function updateInfoBasicReadingLesson($domain, $lesson_id) {
        if (Request::ajax()) {
            $img_url = $_POST['img_url'];
            $img_name = $_POST['img_name'];
            $title_lesson = $_POST['title_lesson'];
            $level_id = $_POST['level_id'];
            $readingLessonModel = new ReadingLesson();
            if ($img_name != '' && $img_url != '') {
                $img_name = stripUnicode($img_name);

                $base_to_php = explode(',', $img_url);

                $data = base64_decode($base_to_php[1]);

                $filepath = base_path() . '/storage/upload/images/img-feature/';

                if (!File::exists($filepath)) {
                    File::makeDirectory($filepath, 0777, true, true);
                }

                $filename_img = base_path() . '/storage/upload/images/img-feature/' . $img_name;

                file_put_contents($filename_img, $data);

                $readingLessonModel->updateInfoBasicLessonReading($lesson_id, $title_lesson, $level_id, $img_name);
            }
            else {
                $readingLessonModel->updateTitleLessonReading($lesson_id, $title_lesson, $level_id);
            }

            return json_encode(['result' => $lesson_id]);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReadingTypeQuestion;
use App\Models\ReadingCategory;
use App\Models\ReadingLearningTypeQuestion;
use App\Models\ReadingQuestion;
use App\Models\ReadingLevel;
use App\Models\ReadingQuestionLearning;
use Request;

class TypeQuestionController extends Controller
{
//    public function createNewTypeQuiz() {
//        if (Request::ajax()) {
//            $typeName = $_GET['typeName'];
//            $readingTypeQuestionModel = new ReadingTypeQuestion();
//            $typeId = $readingTypeQuestionModel->createNewTypeQuestion($typeName);
//            return json_encode(['typeName' => $typeName, 'typeId' => $typeId]);
//        }
////        return "hello";
//    }

    public function getCreateNewTypeQuestion($domain) {
        $readingQuestionLearningModel = new ReadingQuestionLearning();
        $i_ques = $readingQuestionLearningModel::orderBy('question_id_custom', 'desc')->first();
        if ($i_ques == NULL) {
            $id_ques = 1;
        }
        else {
            $id_ques = $i_ques->question_id_custom + 1;
        }
        $readingTypeQuestionModel = new ReadingTypeQuestion();
        $all_type_questions = $readingTypeQuestionModel->getAllTypeQuestion();
        $readingLevelModel = new ReadingLevel();
        $all_levels = $readingLevelModel->getAllLevel();
        return view('admin.readingCreateNewTypeQuestion', compact('all_type_questions', 'all_levels', 'id_ques'));
    }

    public function postCreateNewTypeQuestion(Request $request)
    {
        if (Request::ajax()) {
            $name_type_question = $_POST['name_type_question'];
//            $introduction_type_question = $_POST['introduction_type_question'];
            $readingTypeQuestionModel = new ReadingTypeQuestion();
            $new_type_question_id = $readingTypeQuestionModel->createNewTypeQuestion($name_type_question);
            return json_encode(['new_type_question_id' => $new_type_question_id]);
        }
    }

    public function postCreateNewSectionTypeQuestion(Request $request)
    {
        if (Request::ajax()) {
            $type_question_id = $_POST['type_question_id'];
            $title_section = $_POST['title_section'];
            $name_icon_section = $_POST['name_icon_section'];
            if ($name_icon_section == '') {
                $name_icon_section = 'fa-cog';
            }
            $content_section = $_POST['content_section'];
            $left_section = $_POST['left_section'];
            $right_section = $_POST['right_section'];
            $step_section = $_POST['step_section'];
            $level_id = $_POST['level_id'];
            $view_layout = $_POST['view_layout'];
            $list_answer = $_POST['list_answer'];
            $list_type_questions = $_POST['list_type_questions'];
            $listKeyword = $_POST['listKeyword'];
            $readingLearningTypeQuestionModel = new ReadingLearningTypeQuestion();
            $result = $readingLearningTypeQuestionModel->createNewSectionOfTypeQuestion($type_question_id, $title_section, $level_id, $step_section, $view_layout, $name_icon_section, $content_section, $left_section, $right_section);

            foreach ($list_answer as $qnumber => $answer) {
                $readingQuestionLearningModel = new ReadingQuestionLearning();
                $readingQuestionLearningModel->addNewQuestion($type_question_id, $level_id, $qnumber, $answer, $listKeyword[$qnumber]);
            }

            return json_encode(['result' => 'success']);
        }
    }

    public function getTypeQuestion() {
        if (Request::ajax()) {
            $readingTypeQuestionModel = new ReadingTypeQuestion();
            $list_type_questions = $readingTypeQuestionModel->getAllTypeQuestion();
            return json_encode(['list_type_questions' => $list_type_questions]);
        }
    }

    public function getStepSection() {
        if (Request::ajax()) {
            $type_question_id = $_GET['type_question_id'];
            $step_section = $_GET['step_section'];
            $readingLearningTypeQuestionModel = new ReadingLearningTypeQuestion();
            $step_section = $readingLearningTypeQuestionModel->getStepSection($type_question_id, $step_section);
            return json_encode(['step_section' => $step_section]);
        }
    }
}

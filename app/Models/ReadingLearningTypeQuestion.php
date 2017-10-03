<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadingLearningTypeQuestion extends Model
{
    protected $table = 'reading_learning_type_questions';

    protected $fillable = ['type_question_id', 'level_id', 'step_section', 'title_section', 'view_layout', 'icon', 'content_section', 'left_content', 'right_content', 'status'];

    public $timestamps = true;

    public function getAllSectionByTypeQuestionId($type_question_id) {
        return $this->where('status', 1)
                    ->where('type_question_id', $type_question_id)
                    ->get();
    }

    public function createNewSectionOfTypeQuestion ($type_question_id, $title_section, $level_id, $step_section, $view_layout, $icon, $content_section, $left_content, $right_content) {
        $newSectionOfTypeQuestion = new ReadingLearningTypeQuestion();
        $newSectionOfTypeQuestion->type_question_id = $type_question_id;
        $newSectionOfTypeQuestion->title_section = $title_section;
        $newSectionOfTypeQuestion->level_id = $level_id;
        $newSectionOfTypeQuestion->step_section = $step_section;
        $newSectionOfTypeQuestion->view_layout = $view_layout;
        $newSectionOfTypeQuestion->left_content = $left_content;
        $newSectionOfTypeQuestion->right_content = $right_content;
        $newSectionOfTypeQuestion->icon = $icon;
        $newSectionOfTypeQuestion->content_section = $content_section;
        $newSectionOfTypeQuestion->save();
        return 'success';
    }

    public function getStepSection ($type_question_id, $level_id) {
        return $this->where('status', 1)
                    ->where('type_question_id', $type_question_id)
                    ->where('level_id', $level_id)
                    ->select('step_section')
                    ->orderBy('step_section','asc')
                    ->first();
    }
}

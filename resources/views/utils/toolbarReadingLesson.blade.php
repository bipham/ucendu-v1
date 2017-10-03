<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 7/25/2017
 * Time: 8:29 PM
 */
?>
<div class="menu-left-stick left-position reading-menu-left">
    <div class="toolbar-inner">
        <div class="toolbar-scroll">
            <div class="open-toolbar transform-open-toolbar btn-outline-info" id="toolbar-open">
                <div class="btn-open">
                    <strong class="title-toolbar">Menu </strong>
                    <i class="fa fa-folder icon-toolbar icon-toolbar-close" aria-hidden="true"></i>
                    <i class="fa fa-folder-open icon-toolbar icon-toolbar-open hidden" aria-hidden="true"></i>
                </div>
            </div>
            <div class="toolbar-content transform-content-toolbar">
                <div class="all-type-lesson">
                    <div class="toolbar-header">
                        <h4 class="header-toolbar">
                            Lesson Reading
                        </h4>
                    </div>
                    <div class="toolbar-body">
                        <div class="list-type-questions">
                            <?php
                            $readingTypeQuestionModel = new  App\Models\ReadingTypeQuestion();
                            $list_type_questions = $readingTypeQuestionModel->getAllTypeQuestion();
                            foreach ($list_type_questions as $type_question):
                            $title_type_question = str_replace(" ","-", $type_question->name);
                            ?>
                            <div class="item-type-question">
                                <i class="fa fa-caret-right icon-left-menu-toolbar" aria-hidden="true"></i>
                                <a class="type-lesson-link" href="{{ url('reading/readingTypeQuestion/typeQuestion' . $type_question->id . '-' . $title_type_question) }}">
                                    {!! $type_question->name !!}
                                </a>
                            </div>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>

                <div class="dropdown-divider"></div>

                <div class="mix-test">
                    <div class="toolbar-header">
                        <a class="type-lesson-link" href="{{ url('reading/readingTypeLesson/typeLesson2-mix-test')}}">
                            <h4 class="header-toolbar header-other-lesson">
                                Mix Test
                            </h4>
                        </a>
                    </div>
                </div>

                <div class="dropdown-divider"></div>

                <div class="full-test">
                    <div class="toolbar-header">
                        <a class="type-lesson-link" href="{{url('reading/readingTypeLesson/typeLesson3-full-test')}}">
                            <h4 class="header-toolbar header-other-lesson">
                                Full Test
                            </h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 7/25/2017
 * Time: 10:16 PM
 */
?>
<div class="menu-fix-custom">
    <div class="container">
        <div class="menu menu-reading">
            <div class="pull-right action-user-center-fixed">
                @include('utils.actionCenterUser')
            </div>
            <ul class="nav nav-tabs" id="myTabReading" role="tablist">
                <li class="logo-reading-menu img-thumbnail-middle">
                    <div class="img-thumbnail-inner">
                        <a href="/" class="brand-web">
                            <img src="/public/imgs/original/logo.jpg" alt="Logo" class="img-custom img-middle-responsive img-logo-reading-menu">
                        </a>
                    </div>
                </li>
                <li class="nav-item title-lesson-header">
                    <h4 class="title-type-lesson">
                        @yield('titleTypeLesson')
                    </h4>
                    @yield('typeLessonHeader')
                </li>
                <li class="menu-lesson-header">
                    <div class="btn-group btn-dropdown-products btn-lesson-menu">
                        <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fa fa-folder icon-menu-lesson-dropdown icon-menu-lesson-dropdown-close" aria-hidden="true"></i>
                            <i class="fa fa-folder-open icon-menu-lesson-dropdown icon-menu-lesson-dropdown-open" aria-hidden="true"></i>
                        </button>
                        <div class="dropdown-menu dropdowm-reading-header">
                            <div class="sub-menu-item-custom">
                                <h6 class="dropdown-header dropdown-header-custom">
                                    READING LESSONS
                                </h6>
                                <?php
                                $readingTypeQuestionModel = new  App\Models\ReadingTypeQuestion();
                                $list_type_questions = $readingTypeQuestionModel->getAllTypeQuestion();
                                foreach ($list_type_questions as $type_question):
                                $title_type_question = str_replace(" ","-", $type_question->name);
                                ?>
                                <div class="item-type-question item-type-question-{!! $type_question->id !!}" data-type-question-id="{!! $type_question->id !!}>
                                    <i class="fa fa-caret-right icon-left-menu-toolbar" aria-hidden="true"></i>
                                    <a class="type-lesson-link" href="{{ url('reading/readingTypeQuestion/typeQuestion' . $type_question->id . '-' . $title_type_question) }}">
                                        {!! $type_question->name !!}
                                    </a>
                                </div>
                                <?php
                                endforeach;
                                ?>
                                <div class="dropdown-divider"></div>
                            </div>
                            <div class="sub-menu-item-custom menu-lesson-reading mix-test-lesson-reading">
                                <a class="type-lesson-link" href="{{ url('reading/readingTypeLesson/typeLesson2-mix-test')}}">
                                    <h6 class="dropdown-header dropdown-header-custom">
                                        Mix Test
                                    </h6>
                                </a>
                                <div class="dropdown-divider"></div>
                            </div>
                            <div class="sub-menu-item-custom full-test-menu-lesson-reading">
                                <a class="type-lesson-link" href="{{url('reading/readingTypeLesson/typeLesson3-full-test')}}">
                                    <h6 class="dropdown-header dropdown-header-custom">
                                        Full Test
                                    </h6>
                                </a>
                            </div>
                        </div>
                </li>
                <li class="nav-item tab-reading-control">
                    <a class="nav-link reading-intro" data-toggle="tab" href="#readingIntro" role="tab">Introduction</a>
                </li>
                <li class="nav-item tab-reading-control">
                    <a class="nav-link reading-practice" data-toggle="tab" href="#practice" role="tab">Practice Lessons</a>
                </li>
                <li class="nav-item tab-reading-control">
                    <a class="nav-link reading-test-lesson" data-toggle="tab" href="#readingTestLesson" role="tab">Test Lessons</a>
                </li>
                <li class="nav-item tab-reading-control">
                    <a class="nav-link reading-test-quiz" data-toggle="tab" href="#readingTestQuiz" role="tab">
                        Test Quiz
                        <div class="badge badge-danger countdown-time hidden-class"></div>
                    </a>
                </li>
                <li class="nav-item tab-reading-control">
                    <a class="nav-link reading-solution-quiz" data-toggle="tab" href="#readingSolutionQuiz" role="tab">
                        Solution
                        <div class="badge badge-pill badge-info result-overview"></div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

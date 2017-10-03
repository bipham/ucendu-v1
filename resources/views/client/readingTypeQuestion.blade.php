<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 8/4/2017
 * Time: 1:39 PM
 */
//dd($type_question->introduction);
?>
@extends('layout.masterNoFooter')
@section('meta-title')
    {!! $type_question->name !!}
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/client/readingNavtabsVertical.css')}}">
    <?php
    $bg = array('1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg', '9.jpg', '10.jpg', '11.jpg', '12.jpg', '13.jpg', '14.jpg', '15.jpg');
    $i = rand(0, count($bg)-1); // generate random number size of the array
    $i2 = rand(0, count($bg)-1); // generate random number size of the array
    $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen
    $selectedBg2 = "$bg[$i2]"; // set variable equal to which random filename was chosen
    ?>
    <style type="text/css">
        .outer-banner-custom {
            background: url(/public/imgs/background-header/<?php echo $selectedBg2; ?>);
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            margin-bottom: 10px;
        }

        .header-product {
            background: url(/public/imgs/background-header/<?php echo $selectedBg; ?>);
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
@endsection
@section('banner-page')
    <div class="row-fluid outer-banner-custom">
        <div class="breadcrumb-header middle-banner-custom">
            <div class="content-breadcrumb-header content-banner-custom">
                <h2 class="title-post">{!! $type_question->name !!}</h2>
                <ol class="breadcrumb" id="path">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/reading')}}">READING</a></li>
                    {{--<li class="breadcrumb-item"><a href="{{url('/')}}">asd</a></li>--}}
                </ol>
            </div>
        </div>
    </div>
@endsection
    {{--@include('utils.toolbarReadingLesson')--}}

@section('typeLessonHeader')
    <span class="badge badge-success question-header question-header-{!! $type_question->id !!} type-lesson-header" data-type-question-id="{!! $type_question->id !!}">
        {!! $type_question->name !!}
    </span>
@endsection

@section('readingIntro')
    <div class="row">
        <ul class="nav nav-tabs nav-tabs-vertical-custom nav-tabs-learning-section flex-column col-md-2" id="myTabLearningSection" role="tablist">
            @foreach($all_learning_sections as $learning_section)
                <li class="nav-item nav-item-vertical-tab-custom tab-learning-section-control">
                    <a class="nav-link learning-section-{!! $learning_section->id !!}" data-toggle="tab" href="#learningSection{!! $learning_section->id !!}" role="tab">
                        <div class="icon-learning-section icon-section-custom">
                            <i class="fa {!! $learning_section->icon !!}" aria-hidden="true"></i>
                        </div>
                        <div class="title-learning-section title-section-custom">
                            {!! $learning_section->title_section !!}
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
        <!-- Tab panes -->
        <div class="tab-content col-md-10 content-learning-section-area tab-content-area-custom">
            @foreach($all_learning_sections as $learning_section)
                <div class="tab-pane tab-pane-learning-section tab-pane-learning-section-{!! $learning_section->id !!}" id="learningSection{!! $learning_section->id !!}" role="tabpanel">
                    <div class="container content-learning-section">
                        {!! $learning_section->content_section !!}
                    </div>
                </div>
            @endforeach
        </div>
    </div><!-- /row -->
@endsection

@section('readingPractice')
    <div class="container reading-page page-custom">
        <div class="list-reading-thumbnail">
            <div class="row list-lesson-thumbnail">
                @foreach($practice_lessons as $practice_lesson)
                    <?php
                    $detailTypeQuestionOfQuiz =  $readingTypeQuestionOfQuizModel->getDetailQuizByQuizId($practice_lesson->quiz_id);
                    $quiz_id = $practice_lesson->quiz_id;
                    if (array_key_exists($practice_lesson->lesson_id, $highest_result)) {
                        $highest_result_reading = $highest_result[$practice_lesson->lesson_id];
                    }
                    else {
                        $highest_result_reading = 99999;
                    }
                    ?>
                    @include('utils.contentGrid',['lesson' => $practice_lesson, 'detailTypeQuestionOfQuiz' => json_decode($detailTypeQuestionOfQuiz), 'quiz_id' => $quiz_id, 'highest_result_reading' => $highest_result_reading])
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('readingTest')
    <div class="container reading-page page-custom">
        <div class="list-reading-thumbnail">
            <div class="row list-lesson-thumbnail">
                @foreach($test_lessons as $test_lesson)
                    <?php
                    $detailTypeQuestionOfQuiz =  $readingTypeQuestionOfQuizModel->getDetailQuizByQuizId($test_lesson->quiz_id);
                    $quiz_id = $test_lesson->quiz_id;
                    if (array_key_exists($test_lesson->lesson_id, $highest_result)) {
                        $highest_result_reading = $highest_result[$test_lesson->lesson_id];
                    }
                    else {
                        $highest_result_reading = 99999;
                    }
                    ?>
                    @include('utils.contentGrid',['lesson' => $test_lesson, 'detailTypeQuestionOfQuiz' => json_decode($detailTypeQuestionOfQuiz), 'quiz_id' => $quiz_id, 'highest_result_reading' => $highest_result_reading])
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('public/js/client/lessonDetail.js')}}"></script>
    <script>
        $(function () {
            $('#myTabReading a.reading-intro').tab('show');
            $('#myTabReading a.reading-test-quiz').addClass('hidden');
            $('#myTabReading a.reading-solution-quiz').addClass('hidden');
        });
        $(document).ready(function() {
            $('#myTabLearningSection li.tab-learning-section-control a:first').tab('show');
        });
    </script>
@endsection


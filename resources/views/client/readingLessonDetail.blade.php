<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 7/18/2017
 * Time: 8:30 PM
 */
//dd($practice_lessons);
?>
@extends('layout.masterNoFooter')
@section('meta-title')
    {!! $lesson_detail->title !!}
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
                <h2 class="title-post">{!! $lesson_detail->title !!}</h2>
                <ol class="breadcrumb" id="path">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/reading')}}">READING</a></li>
                    <li class="breadcrumb-item">
                        <a href="#">
                            @if ($type_lesson == 1)
                                    {!! $type_question->name !!}
                            @elseif ($type_lesson == 2)
                               Mix Test
                            @elseif ($type_lesson == 3)
                                Full Test
                            @endif
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
@endsection
{{--@include('utils.toolbarReadingLesson')--}}

@section('titleTypeLesson')
    {!! $lesson_detail->title !!}
@endsection

@section('typeLessonHeader')
    @if ($type_lesson == 1)
        <span class="badge badge-success question-header question-header-{!! $type_question->id !!} type-lesson-header" data-type-question-id="{!! $type_question->id !!}">
                        {!! $type_question->name !!}
                    </span>
    @elseif ($type_lesson == 2)
        <span class="badge badge-warning mix-test-header mix-test-header-{!! $type_lesson !!} type-lesson-header" data-type-lesson-id="{!! $type_lesson !!}">
                       Mix Test
                    </span>
    @elseif ($type_lesson == 3)
        <span class="badge badge-danger full-test-header full-test-header-{!! $type_lesson !!} type-lesson-header" data-type-lesson-id="{!! $type_lesson !!}">
                        Full Test
                    </span>
    @endif
@endsection

@section('readingIntro')
    @if($type_lesson == 1):
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
    @endif
@endsection

@section('readingPractice')
    <div class="container reading-page page-custom">
        <div class="list-reading-thumbnail">
            <div class="row list-lesson-thumbnail">
                @foreach($practice_lessons as $practice_lesson)
                    @if($type_lesson == 1)
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
                    @else
                        <?php
                        $detailTypeQuestionOfQuiz =  $readingTypeQuestionOfQuizModel->getDetailQuizByQuizId($practice_lesson->id);
                        //                        dd($detailTypeQuestionOfQuiz);
                        //                            dd($practice_lesson);
                        $quiz_id = $practice_lesson->id;
                        if (array_key_exists($practice_lesson->lesson_id, $highest_result)) {
                            $highest_result_reading = $highest_result[$practice_lesson->lesson_id];
                        }
                        else {
                            $highest_result_reading = 99999;
                        }
                        ?>
                    @endif

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
                    @if($type_lesson == 1)
                        <?php
                        $detailTypeQuestionOfQuiz =  $readingTypeQuestionOfQuizModel->getDetailQuizByQuizId($test_lesson->quiz_id);
                        //                        dd($detailTypeQuestionOfQuiz);
                        $quiz_id = $test_lesson->quiz_id;
                        if (array_key_exists($test_lesson->lesson_id, $highest_result)) {
                            $highest_result_reading = $highest_result[$test_lesson->lesson_id];
                        }
                        else {
                            $highest_result_reading = 99999;
                        }
                        ?>
                    @else
                        <?php
                        $detailTypeQuestionOfQuiz =  $readingTypeQuestionOfQuizModel->getDetailQuizByQuizId($test_lesson->id);
                        //                        dd($detailTypeQuestionOfQuiz);
                        $quiz_id = $test_lesson->id;
                        if (array_key_exists($test_lesson->lesson_id, $highest_result)) {
                            $highest_result_reading = $highest_result[$test_lesson->lesson_id];
                        }
                        else {
                            $highest_result_reading = 99999;
                        }
                        ?>
                    @endif
                    @include('utils.contentGrid',['lesson' => $test_lesson, 'detailTypeQuestionOfQuiz' => json_decode($detailTypeQuestionOfQuiz), 'quiz_id' => $quiz_id, 'highest_result_reading' => $highest_result_reading])
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('readingTestQuiz')
    @include('utils.readingLessonTestTools',['lesson_detail' => $lesson_detail, 'lesson_quiz' => $lesson_quiz])
    <div class="container lesson-detail-page page-custom">
        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
        <div class="overlay-lesson">
            <div class="row-fluid header-product outer-banner-custom">
                <div class="breadcrumb-header middle-banner-custom">
                    <div class="content-breadcrumb-header content-banner-custom">
                        <div class="breadcrumb-custom-area">
                            <h2 class="title-post">{!! $lesson_detail->title !!}</h2>
                            <ol class="breadcrumb" id="path">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{url('/reading')}}">READING</a></li>
                                <li class="breadcrumb-item">
                                    <a href="#">
                                        @if ($type_lesson == 1)
                                            {!! $type_question->name !!}
                                        @elseif ($type_lesson == 2)
                                            Mix Test
                                        @elseif ($type_lesson == 3)
                                            Full Test
                                        @endif
                                    </a>
                                </li>
                            </ol>
                        </div>
                        <div class="info-overview">
                            <div class="badge badge-primary countdown-time-overview"></div>
                            <h4 class="reading-title-start">
                                Are you ready?
                            </h4>
                            <button type="button" class="btn btn-outline-danger btn-reading-start-test">START</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lesson-detail panel-container hidden">
            <div class="left-panel-custom panel-left panel-top" id="lesson-content-area" data-lessonid="{!! $lesson_detail->id !!}">
                {!! $lesson_detail->content_lesson !!}
            </div>
            <div class="splitter">
            </div>
            <div class="splitter-horizontal">
            </div>
            <div class="right-panel-custom panel-right panel-bottom @if ($lesson_quiz->limit_time == 0) active-quiz @endif" id="quiz-test-area" data-quizId="{!! $lesson_quiz->id !!}" data-limit-time="{!! $lesson_quiz->limit_time !!}">
                {!! $lesson_quiz->content_quiz !!}
                <div class="reading-end-lesson end-lesson-area">
                    <h4 class="title-end-lesson">
                        --- End of the Test ---
                    </h4>
                    <h5 class="recomment-submit-lesson">
                        Please Submit to view your score, solution and explanations.
                    </h5>
                    <button type="submit" class="btn btn-danger btn-submit-modal btn-custom" data-toggle="modal" data-target="#readingSubmitQuizModal">
                        Submit
                    </button>
                    <div class="found-mistake">
                        <a href="#" class="send-mistake">
                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                            Found a mistake? Let us know!
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('public/js/client/lessonDetail.js')}}"></script>
    <script src="{{asset('public/libs/countdown/jquery.countdown.js')}}"></script>
    <script>

        var type_lesson = <?php print_r($type_lesson); ?>;
        $(function () {
            $('#myTabReading a.reading-test-quiz').tab('show');
            if (type_lesson != 1) {
                $('#myTabReading a.reading-intro').addClass('hidden');
            }
            $('#myTabReading a.reading-solution-quiz').addClass('hidden');
        });

        var limit_time = <?php print_r($lesson_quiz->limit_time); ?>;
        var show_time_quiz = limit_time/60;
        if (show_time_quiz > 0) {
            $('.countdown-time').removeClass('hidden-class');
            if (show_time_quiz == 1) {
                $('.countdown-time-overview').html(show_time_quiz + ' min');
            }
            else {
                $('.countdown-time-overview').html(show_time_quiz + ' mins');
            }
        }
        else {
            $('.countdown-time-overview').remove();
        }

        $('.btn-reading-start-test').click(function () {
            isStart = true;
            var limit_time_quiz = new Date().getTime() + limit_time*1000;
            $('.lesson-detail').removeClass('hidden');
            $('header#header').addClass('hidden');
            $('.menu-reading').addClass('reading-header-fixed');
            $('.overlay-lesson').addClass('overlay-lesson-active');
            $('footer.navbar-fixed-bottom').addClass('hidden');
            $('.right-panel-custom').addClass('active-quiz');
            $('html,body').animate({
                scrollTop: 0
            }, 500);
            $('.countdown-time').css('display', 'block');
            $('.countdown-time').countdown(limit_time_quiz, function(event) {
                $(this).html(event.strftime('%M:%S'))
            })
                .on('finish.countdown', function(event) {
//                    console.log('aaaaa');
                    var result_quiz = getAnsweredQuestionOverview();
                    var dialog = bootbox.dialog({
                        title: 'End time!',
                        message:    '<h5 class="title-auto-submit">You answered <span class="result-test">' + result_quiz + '</span> questions</h5>' +
                                    '<p><i class="fa fa-spin fa-spinner"></i> Your result is submitting...</p>',
    //                    size: 'large',
                        closeButton: false
                    });
                    dialog.init(function(){
                        $('.menu-left-stick').addClass('hidden');
                        $('.reading-tool-lesson-quiz').addClass('hidden');
                        setTimeout(function(){
                            submitReadingTest();
                        }, 3000);
                    });

                });
            $('.reading-tool-lesson-quiz').removeClass('hidden');
        });
    </script>
@endsection

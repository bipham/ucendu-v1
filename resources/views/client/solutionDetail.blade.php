<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 7/18/2017
 * Time: 8:30 PM
 */
//dd($lesson_quiz);
?>
@extends('layout.masterNoFooter')
@section('meta-title')
    Solution Detail
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/client/readingSolution.css')}}">
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
            height: 300px;
            margin-bottom: 30px;
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
                        //                            dd($practice_lesson);
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

@endsection

@section('readingSolutionQuiz')
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

                </div>
            </div>
        </div>
    </div>
    <div class="container solution-detail-page page-custom">
        @include('utils.readingSolutionTables', ['lesson_detail' => $lesson_detail, 'lesson_quiz' => $lesson_quiz, 'correct_answers' => $correct_answer, 'list_answered' => $list_answer])
        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
        <h4 class="title-solution-detail-section">
            Solution Detail
        </h4>
        <div class="solution-detail panel-container">
            <div class="left-panel-custom panel-left panel-top" id="lesson-highlight-area" data-lessonid="{!! $lesson_detail->id !!}">
                {!! $lesson_detail->content_highlight !!}
            </div>
            <div class="splitter">
            </div>
            <div class="splitter-horizontal">
            </div>
            <div class="right-panel-custom panel-right panel-bottom active-quiz" id="solution-area" data-quizId="{!! $lesson_quiz->id !!}">
                {!! $lesson_quiz->content_answer_quiz !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('public/js/client/solutionDetail.js')}}"></script>
    <script src="{{asset('public/libs/chart/Chart.min.js')}}"></script>
    <script type="text/javascript">
        var type_lesson = <?php print_r($type_lesson); ?>;
        $(function () {
            $('#myTabReading a.reading-solution-quiz').tab('show');
            $('#myTabReading a.reading-test-quiz').addClass('hidden');
            if (type_lesson != 1) {
                $('#myTabReading a.reading-intro').addClass('hidden');
            }
        });
        var correct_answers = <?php print_r(json_encode($correct_answer)); ?>;
        var totalQuestion = <?php print_r(json_encode($totalQuestion)); ?>;
        if (totalQuestion != 0) {
            var number_correct_answer = correct_answers.length;
            $('.result-overview').html(number_correct_answer + '/' + totalQuestion);
        }
        var list_answer = <?php print_r(json_encode($list_answer)); ?>;
        $('.question-quiz').each(function () {
            var qnumber = $(this).data('qnumber');
            var qorder = $(this).attr('name');
            var solution_key = $('.explain-area-' + qnumber + ' .key-answer').html();
            console.log('a: ' + solution_key);
            qorder = qorder.match(/\d+/);
            var answer_key = list_answer[qnumber];
            if (answer_key) {
                $('.name-answered-' + qorder).html('Your choice');
                $('.view-your-choice-' + qorder).html(answer_key);
            }
            $('.view-solution-question-' + qorder).html(solution_key);

            if(jQuery.inArray(qnumber, correct_answers) !== -1) {
                $('.question-table-' + qorder + ' .selected-false-icon').addClass('hidden');
                $('.question-table-' + qorder + ' .selected-true-icon').removeClass('hidden');
            }

            if ($(this).hasClass('question-radio')) {
                if (answer_key) {
                    $('input[value=' + answer_key + '].question-' + qorder,'#solution-area').prop( "checked", true);
                }
            }
            else if ($(this).hasClass('question-checkbox')) {
                if (answer_key) {
                    var array_answer = answer_key.split(' & ');
                    for (var i = 0; i < array_answer.length; i++) {
                        $('input[value=' + array_answer[i] + '].question-' + qorder,'#solution-area').prop( "checked", true);
                    }

                }
            }
            else if ($(this).hasClass('question-input')) {
                if (answer_key) {
                    $(this).val(answer_key);
                }
            }
            else if ($(this).hasClass('question-select')) {
                if (answer_key) {
                    $(this).val(answer_key);
                }
            }
        });
        $('.explain-area').each(function () {
            var qnumber = $(this).data('qnumber');
            if(jQuery.inArray(qnumber, correct_answers) !== -1) {
                $('.explain-area-' + qnumber + ' .show-answer .btn-show-answer').after('<i class="fa selected-true-icon fa-check-circle-o" aria-hidden="true"></i>');
            }
            else {
                $('.explain-area-' + qnumber + ' .show-answer .btn-show-answer').after('<i class="fa selected-false-icon fa-times-circle-o" aria-hidden="true"></i>');
            }
        });

        //Canvas Chart:
        var ctx = document.getElementById("myChartReadingScore").getContext('2d');
        var total_q = $('.stats-total-question .stats-value').html();
        var correct_q = $('.stats-correct .stats-value').html();
        var incorrect_q = $('.stats-incorrect .stats-value').html();
        var unanswered_q = $('.stats-unanswered .stats-value').html();
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Total", "Correct", "Incorrect", "No choice"],
                datasets: [{
                    label: '# Total questions',
                    data: [total_q, correct_q, incorrect_q, unanswered_q],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>
@endsection

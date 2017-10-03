<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 7/26/2017
 * Time: 1:00 AM
 */
//dd($lessons);
//dd($test_lessons);
?>
@extends('layout.masterNoFooter')
@section('meta-title')
    @if($type_lesson_id == 2 )
        Mix Test
    @elseif($type_lesson_id == 3)
        Full Test
    @endif
@endsection
{{--@include('utils.toolbarReadingLesson')--}}

@section('typeLessonHeader')
    @if ($type_lesson_id == 1)
        <span class="badge badge-success question-header question-header-{!! $type_question->id !!} type-lesson-header" data-type-question-id="{!! $type_question->id !!}">
            {!! $type_question->name !!}
        </span>
    @elseif ($type_lesson_id == 2)
        <span class="badge badge-warning mix-test-header mix-test-header-{!! $type_lesson_id !!} type-lesson-header" data-type-lesson-id="{!! $type_lesson_id !!}">
            Mix Test
        </span>
    @elseif ($type_lesson_id == 3)
        <span class="badge badge-danger full-test-header full-test-header-{!! $type_lesson_id !!} type-lesson-header" data-type-lesson-id="{!! $type_lesson_id !!}">
            Full Test
        </span>
    @endif
@endsection

@section('readingPractice')
    <div class="container reading-page page-custom">
        <div class="list-reading-thumbnail">
            <div class="row list-lesson-thumbnail">
                @foreach($practice_lessons as $practice_lesson)
                    <?php
                    $detailTypeQuestionOfQuiz =  $readingTypeQuestionOfQuizModel->getDetailQuizByQuizId($practice_lesson->id);
                    $quiz_id = $practice_lesson->id;
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
                    $detailTypeQuestionOfQuiz =  $readingTypeQuestionOfQuizModel->getDetailQuizByQuizId($test_lesson->id);
                    $quiz_id = $test_lesson->id;
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
            $('#myTabReading a.reading-practice').tab('show');
            $('#myTabReading a.reading-test-quiz').addClass('hidden');
            $('#myTabReading a.reading-intro').addClass('hidden');
            $('#myTabReading a.reading-solution-quiz').addClass('hidden');
        })
    </script>
@endsection

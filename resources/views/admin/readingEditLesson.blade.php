<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 8/17/2017
 * Time: 2:04 AM
 */
?>

@extends('layout.masterNoMenu')
@section('meta-title')
    Edit Lesson
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/admin/upload.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/client/readingSolution.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/admin/readingEditLesson.css')}}">
    {{--    <meta name="csrf-token" content="{{ csrf_token() }}" />--}}
    <script src="/public/libs/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <div class="container upload-page-custom container-page-custom" data-idquestion="{!! $id_ques !!}" data-lesson-id="{!! $lesson_detail->id !!}" data-quiz-id="{!! $lesson_quiz->id !!}">
        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
        <div class="preview-lesson">
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
        <div class="control-edit-lesson-area">
            <button type="button" class="btn btn-primary btn-edit-content-lesson btn-custom-edit-lesson">
                <i class="fa fa-pencil-square-o icon-reading-edit-lesson" aria-hidden="true"></i>
                Content
            </button>
            <button type="button" class="btn btn-success btn-edit-quiz-lesson btn-custom-edit-lesson">
                <i class="fa fa-pencil-square-o icon-reading-edit-lesson" aria-hidden="true"></i>
                Quiz
            </button>
        </div>
        <!-- Edit Content Lesson Area-->
        <div class="edit-content-lesson hidden">
            <div class="edit-content">
                <textarea name="editor_lesson" id="contentLesson">
                {!! $lesson_detail->content_lesson !!}
            </textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'editor_lesson' );
                </script>
                <div class="control-edit-lesson-content">
                    <button type="button" class="btn btn-success btn-next-edit-highlight btn-edit-custom">
                        Next
                    </button>
                </div>
            </div>
            <div class="row edit-highlight hidden">
                <div class="col-md-8 card highlight-sandbox">
                    <div class="card-header">
                        <h3 class="text-left">
                            Highlight đáp án!
                        </h3>
                    </div>
                    <div class="card-block">
                        <div id="sandbox">
                            {!! $lesson_detail->content_highlight !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 card remove-tool-area">
                    <div class="card-header">
                        <h3 class="text-left">
                            Remove highlight!
                        </h3>
                    </div>
                    <div class="card-block remove-highlight-area">

                    </div>
                </div>
                <div class="control-edit-lesson-highlight">
                    <button type="button" class="btn btn-success btn-back-edit-content btn-edit-custom">
                        Prev
                    </button>
                    <button type="button" class="btn btn-danger btn-save-edit-lesson btn-edit-custom">
                        Save
                    </button>
                </div>
            </div>
        </div>

        <!-- Edit Quiz Lesson Area-->
        <div class="edit-quiz-lesson hidden">
            <div class="edit-quiz">
                <div class="form-group">
                    <label for="typelesson">
                        Loại Bài học!
                    </label>
                    <select class="form-control" id="typeLesson" name="typelesson" >
                        <option value="1" @if (1 == $lesson_quiz->type_lesson) selected @endif>1 dạng!</option>
                        <option value="2" @if (2 == $lesson_quiz->type_lesson) selected @endif>Nhiều dạng (mix type)!</option>
                        <option value="3" @if (3 == $lesson_quiz->type_lesson) selected @endif>Full test!</option>
                    </select>

                    <label for="limittime">
                        Limit Time!
                    </label>
                    <input type="number" name="limittime" class="form-control" required id="limitTime" value="{!! $lesson_quiz->limit_time !!}">
                </div>
                <textarea name="editor_quiz" id="quizLesson">
                {!! $lesson_quiz->content_quiz !!}
            </textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'editor_quiz' );
                </script>
                <div class="control-edit-lesson-content">
                    <button type="button" class="btn btn-success btn-next-edit-answer btn-edit-custom">
                        Next
                    </button>
                </div>
            </div>
            <div class="row edit-answer hidden">
                <div class="type-only-question-area full-width-class">
                </div>
                <div class="col-md-8 card preview-content-quiz">
                    <div class="card-header">
                        <h3 class="text-left">
                            Nội dung câu hỏi:
                        </h3>
                    </div>
                    <div class="card-block">
                    </div>
                </div>
                <div class="col-md-4 card answer-key-area">
                    <div class="card-header">
                        <h3 class="text-left">
                            Đáp án:
                        </h3>
                    </div>
                    <div class="card-block">
                        <div class="answer-area">
                        </div>
                    </div>
                </div>
                <div class="control-step-area">
                    <button type="button" class="btn btn-success btn-back-edit-quiz btn-edit-custom">
                        Prev
                    </button>
                    <button type="button" class="btn btn-success btn-next-preview-edit btn-edit-custom">
                        Next
                    </button>
                </div>
            </div>
            <div class="row preview-edit-lesson hidden">
                <div class="col-md-6 card preview-post">
                    <div class="card-header">
                        <h3 class="text-left">
                            Noi dung Post!
                        </h3>
                    </div>
                    <div class="card-block">
                        <div id="pr-post">
                            {!! $lesson_detail->content_highlight !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 card preview-quiz">
                    <div class="card-header">
                        <h3 class="text-left">
                            Noi dung Quiz!
                        </h3>
                    </div>
                    <div class="card-block">
                        <div id="pr-quiz">

                        </div>
                    </div>
                </div>
                <div class="control-step-area">
                    <button type="button" class="btn btn-success btn-back-edit-answer btn-edit-custom">
                        Prev
                    </button>
                    <button type="submit" class="btn btn-danger btn-update-quiz-lesson btn-edit-custom">
                        Save
                    </button>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
    {{--<script src="{{asset('public/js/admin/upload.js')}}"></script>--}}
    <script src="{{asset('public/js/admin/readingEditLesson.js')}}"></script>
    <script src="{{asset('public/js/admin/readingHighlight.js')}}"></script>
    <script src="{{asset('public/js/client/solutionDetail.js')}}"></script>
@endsection
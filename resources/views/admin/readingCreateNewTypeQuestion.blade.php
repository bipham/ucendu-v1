<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 8/11/2017
 * Time: 11:24 AM
 */
?>

@extends('layout.masterNoMenu')
@section('meta-title')
    Reading - Create New Type Question
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/admin/admin-style.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/admin/upload.css')}}">
    <script src="/public/libs/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <div class="container new-learning-container upload-page-custom" data-idquestion="{!! $id_ques !!}">
        @include('utils.message')
        {{--@include('errors.input')--}}
        <form role="form" action="{!!url('createNewTypeQuestion')!!}" method="POST">
            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
            <h1 class="title-new-type-action">Create New Type Question</h1>
            <div class="row step-first">
                <div class="form-group">
                    <label for="list_type_questions">
                        Chon dạng câu hỏi!
                    </label>
                    <select class="form-control" id="list_type_questions" name="list_type_questions" >
                        <option value="">Chon dạng câu hỏi!</option>
                        <?php
                        foreach ($all_type_questions as $type_question):
                            echo '<option value="' . $type_question->id . '">' . $type_question->name . '</option>';
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="create_new_type_question">
                        Hoặc tạo mới dạng câu hỏi!
                    </label>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-tool-type-question btn-create-new-type-question btn-custom" data-toggle="modal" data-target="#readingCreateNewTypeQuestion">
                        Create New
                        <i class="fa fa-info icon-tool-type-question" aria-hidden="true"></i>
                    </button>
                    <div class="modal fade" id="readingCreateNewTypeQuestion" tabindex="-1" role="dialog" aria-labelledby="readingCreateNewTypeQuestionLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="readingReviewQuizModalLabel">
                                        Create New Type Question
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="type_question_name">
                                            Name of type question
                                        </label>
                                        <input type="text" class="form-control" placeholder="Name type question" id="type_question_name" name="type_question_name" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning btn-finish-new-type-question">
                                        Create
                                    </button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="list_level">
                        Chon level!
                    </label>
                    <select class="form-control" id="list_level" name="list_level" >
                        <?php
                        foreach ($all_levels as $all_level):
                            echo '<option value="' . $all_level->id . '">' . $all_level->level . '</option>';
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="title_section">
                        Title section
                    </label>
                    <input type="text" class="form-control" placeholder="Title section" id="title_section" name="title_section" required>
                </div>
                <div class="form-group">
                    <label for="name_icon_section">
                        Icon section
                    </label>
                    <input type="text" class="form-control" placeholder="fa-cog" id="name_icon_section" name="name_icon_section" required>
                </div>
                <button type="button" class="btn btn-primary btn-next-step-second">
                    Next
                </button>
            </div>
            <div class="row step-second hidden">
                <div class="form-group">
                    <label for="view_layout">
                        View layout
                    </label>
                    <input type="number" class="form-control" min="1" max="2" value="1" placeholder="View layout" id="view_layout" name="view_layout" required>
                </div>
                <div class="form-group">
                    <label for="content_section">
                        Nội dung
                    </label>
                    <textarea id="content_section" rows="10" cols="80" name="content_section"></textarea>
                    <script>
                        CKEDITOR.replace( 'content_section' );
                    </script>
                </div>
                <div class="form-group left-content-group hidden two-layout-content">
                    <label for="left_section">
                        Left content
                    </label>
                    <textarea id="left_section" rows="10" cols="80" name="left_section"></textarea>
                    <script>
                        CKEDITOR.replace( 'left_section' );
                    </script>
                </div>
                <div class="form-group right-content-group hidden two-layout-content">
                    <label for="right_section">
                        Right content
                    </label>
                    <textarea id="right_section" rows="10" cols="80" name="right_section"></textarea>
                    <script>
                        CKEDITOR.replace( 'right_section' );
                    </script>
                </div>
                <div class="btn-area-custom">
                    <button type="button" class="btn btn-primary btn-prev-step-first">
                        Prev
                    </button>
                    <button type="button" class="btn btn-primary btn-next-step-third">
                        Next
                    </button>
                </div>
            </div>
            <div class="row step-third hidden">
                <div class="form-group">
                    <label for="step_section">
                        Step section
                    </label>
                    <input type="number" class="form-control" min="1" value="1" placeholder="Step section" id="step_section" name="step_section" required>
                </div>
                <div class="col-md-8 card preview-content-quiz">
                    <div class="card-header">
                        <h3 class="text-left">
                            Nội dung:
                        </h3>
                    </div>
                    <div class="card-block">
                    </div>
                </div>
                <div class="col-md-4 answer-key-area">
                    <div class="card-header">
                        <h3 class="text-left">
                            Đáp án:
                        </h3>
                    </div>
                    <div class="card-block">
                        <h6 class="no-question">No Question!</h6>
                        <div class="answer-area">

                        </div>
                    </div>
                </div>
                <div class="btn-area-custom">
                    <button type="button" class="btn btn-primary btn-prev-step-second">
                        Prev
                    </button>
                    <button type="button" class="btn btn-warning btn-create-new-section-type-question">
                        Create section
                    </button>
                </div>
            </div>

        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('public/js/admin/readingNewTypeQuestion.js')}}"></script>
@endsection

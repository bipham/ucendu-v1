<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 11-Jun-17
 * Time: 18:49
 */
?>

@extends('layout.masterNoMenu')
@section('meta-title')
    Home
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/admin/upload.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/client/readingSolution.css')}}">
{{--    <meta name="csrf-token" content="{{ csrf_token() }}" />--}}
    <script src="/public/libs/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <div class="container upload-page-custom container-page-custom" data-idquestion="{!! $id_ques !!}">
        <form role="form" action="{!!url('getUploadReadingLesson')!!}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
            <div class="row row-steps-info">
                dsadsd
            </div>
            <div class="row step-content-post">
                <div class="card content-post-area card-step-area">
                    <div class="card-header">
                        <h3 class="text-left">
                            Nội dung bài viết
                        </h3>
                    </div>
                    <div class="card-block">
                        <div class="form-content">
                            <div class="form-group">
                                <label for="prtcate">
                                    Chọn Danh Mục
                                </label>
                                <select class="form-control" id="prtcate" name="prtcate" >
                                    <option value="">Chon danh muc!</option>
                                    <?php
                                    foreach ($list_cate as $cate):
                                        echo '<option value="' . $cate->id . '">' . $cate->name . '</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="create-new-cate">
                                    Tao danh muc moi
                                </label>
                                <input type="text" name="create-new-cate" class="form-control" placeholder="Điền vào đây" required id="newCate">
                                <button type="button" class="btn btn-success btn-create-new-cate">
                                    Create
                                </button>
                            </div>
                            <div class="form-group">
                                <label for="itemname">
                                    Tên Bài Viết
                                </label>
                                <input type="text" name="itemname" class="form-control" placeholder="Điền vào đây" required id="itemname">
                            </div>
                            <div class="form-group form-upload-img-custom">
                                <label>Hình Đại Diện</label>
                                <input type="file" name="image-main" onchange="readURL(this);" required id="imgFeature">
                                <img id="image-main-preview" class="img-upload-product hidden-class" src="#" alt="Ảnh" />
                            </div>
                            <div class="form-group">
                                <label for="content">
                                    Nội dung
                                </label>
                                <textarea name="editor_post" id="contentPost" rows="10" cols="80">
                                    Content Post is here!
                                </textarea>
                                <script>
                                    // Replace the <textarea id="editor1"> with a CKEditor
                                    // instance, using default configuration.
                                    CKEDITOR.replace( 'editor_post' );
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="control-step-area">
                    <button type="button" class="btn btn-success btn-next-step-quiz btn-custom-step">
                        Next
                    </button>
                </div>
            </div>
            <div class="row step-content-quiz hidden-class">
                <div class="card content-quiz-area card-step-area">
                    <div class="card-header">
                        <h3 class="text-left">
                            Nội dung câu hỏi:
                        </h3>
                    </div>
                    <div class="card-block">
                        <div class="form-group">
                            <label for="typelesson">
                                Loại Bài học!
                            </label>
                            <select class="form-control" id="typeLesson" name="typelesson" >
                                <option value="1">1 dạng!</option>
                                <option value="2">Nhiều dạng (mix type)!</option>
                                <option value="3">Full test!</option>
                            </select>

                            <label for="limittime">
                                Limit Time!
                            </label>
                            <input type="number" name="limittime" class="form-control" required id="limitTime" value="0">
                        </div>
                        <div class="form-group">
                            <label for="content">
                                Nội dung
                            </label>
                            <textarea name="editor_quiz" id="contentQuiz" rows="10" cols="80">
                                    Content Post is here!
                                </textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'editor_quiz' );
                            </script>
                        </div>
                    </div>
                </div>
                <div class="control-step-area">
                    <button type="button" class="btn btn-success btn-prev-step-post btn-custom-step">
                        Prev
                    </button>
                    <button type="button" class="btn btn-success btn-next-step-answer btn-custom-step">
                        Next
                    </button>
                </div>
            </div>
            <div class="row step-answer-key hidden-class">
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
                    <button type="button" class="btn btn-success btn-prev-step-quiz btn-custom-step">
                        Prev
                    </button>
                    <button type="button" class="btn btn-success btn-next-step-highlight btn-custom-step">
                        Next
                    </button>
                </div>
            </div>
            <div class="row step-highlight-answer hidden-class">
                <div class="col-md-8 card highlight-sandbox">
                    <div class="card-header">
                        <h3 class="text-left">
                            Highlight đáp án!
                        </h3>
                    </div>
                    <div class="card-block">
                        <div id="sandbox"> </div>
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
                <div class="control-step-area">
                    <button type="button" class="btn btn-success btn-prev-step-answer btn-custom-step">
                        Prev
                    </button>
                    <button type="button" class="btn btn-success btn-next-step-preview btn-custom-step">
                        Next
                    </button>
                </div>
            </div>
            <div class="row step-preview-post hidden-class">
                <div class="col-md-6 card preview-post">
                    <div class="card-header">
                        <h3 class="text-left">
                            Noi dung Post!
                        </h3>
                    </div>
                    <div class="card-block">
                        <div id="pr-post"> </div>
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
                    <button type="button" class="btn btn-success btn-prev-step-highlight btn-custom-step">
                        Prev
                    </button>
                    <button type="submit" class="btn btn-danger btn-finish-steps btn-custom-step">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('public/js/admin/upload.js')}}"></script>
    <script src="{{asset('public/js/client/solutionDetail.js')}}"></script>
@endsection
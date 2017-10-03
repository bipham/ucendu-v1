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
    Reading - Create New Vocabulary
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/admin/admin-style.css')}}">
    <script src="/public/libs/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <div class="container">
        @include('utils.message')
        {{--@include('errors.input')--}}
        <form role="form" action="{!!url('createNewVocabulary')!!}" method="POST">
            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
            <h1 class="title-new-type-voca">Create New Type Vocabulary</h1>
            <div class="form-group">
                <label for="list_vocabularies">
                    Chon từ vựng!
                </label>
                <select class="form-control" id="list_vocabularies" name="list_vocabularies" >
                    <option value="">Chon từ vựng!</option>
                    <?php
                    foreach ($all_vocabularies as $vocabulary):
                        echo '<option value="' . $vocabulary->id . '">' . $vocabulary->name . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="create_new_vocabulary">
                    Hoặc tạo mới từ vựng!
                </label>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-tool-vocabulary btn-create-new-vocabulary btn-custom" data-toggle="modal" data-target="#readingCreateNewVocabulary">
                    Create New
                    <i class="fa fa-info icon-tool-vocabulary" aria-hidden="true"></i>
                </button>
                <div class="modal fade" id="readingCreateNewVocabulary" tabindex="-1" role="dialog" aria-labelledby="readingCreateNewVocabularyLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="readingReviewQuizModalLabel">
                                    Create New Vocabulary
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name_vocabulary">
                                        Name Vocabulary
                                    </label>
                                    <input type="text" class="form-control" placeholder="Name Vocabulary" id="name_vocabulary" name="name_vocabulary" required>
                                </div>
                                <div class="form-group">
                                    <label for="name_icon_vocabulary">
                                        Icon
                                    </label>
                                    <input type="text" class="form-control" placeholder="fa-star" id="name_icon_vocabulary" name="name_icon_vocabulary" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning btn-finish-new-type-voca">
                                    Create
                                </button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="name_phrase_word">
                    Name phrase words
                </label>
                <input type="text" class="form-control" placeholder="phrase words" id="name_phrase_word" name="name_phrase_word" required>
            </div>
            <div class="form-group">
                <label for="content_phrase_vocabulary">
                    Nội dung
                </label>
                <textarea id="content_phrase_vocabulary" rows="10" cols="80" name="content_phrase_vocabulary"></textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace('content_phrase_vocabulary');
                </script>
            </div>
            <button type="button" class="btn btn-warning btn-create-new-phrase-word">
                Create Phrase Word
            </button>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('public/js/admin/readingNewVocabulary.js')}}"></script>
@endsection

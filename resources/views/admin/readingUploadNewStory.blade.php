<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 9/7/2017
 * Time: 10:38 AM
 */
?>
@extends('layout.masterNoMenu')
@section('meta-title')
    Reading - Upload new story
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/admin/admin-style.css')}}">
    <script src="/public/libs/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <div class="container">
        @include('utils.message')
        {{--@include('errors.input')--}}
        <form role="form" action="{!!url('uploadReadingStory')!!}" method="POST">
            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
            <h1 class="title-new-upload-story">Upload new english story!</h1>
            <div class="form-group">
                <label for="list_stories">
                    Chon story!
                </label>
                <select class="form-control" id="list_stories" name="list_stories" >
                    <option value="">Chon story!</option>
                    <?php
                    foreach ($list_stories as $story):
                        echo '<option value="' . $story->id . '">' . $story->title . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="create_new_story">
                    Hoặc tạo mới story!
                </label>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-tool-new-story btn-create-new-story btn-custom" data-toggle="modal" data-target="#readingCreateNewStory">
                    New Story
                    <i class="fa fa-info icon-tool-type-question" aria-hidden="true"></i>
                </button>
                <div class="modal fade" id="readingCreateNewStory" tabindex="-1" role="dialog" aria-labelledby="readingCreateNewStoryLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="readingReviewQuizModalLabel">
                                    Create New Story
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="new_title_story">
                                        Name story
                                    </label>
                                    <input type="text" class="form-control" placeholder="Name story" id="new_title_story" name="new_title_story" required>
                                </div>
                                <div class="form-group form-upload-img-custom">
                                    <label>Cover Story</label>
                                    <input type="file" name="image-main-story" onchange="readCoverStory(this);" required id="imgFeature-story" data-type="story">
                                    <img id="image-main-preview-story" class="img-upload-product hidden-class" src="#" alt="Ảnh" />
                                </div>
                                <div class="form-group">
                                    <label for="name_author">
                                        Name author
                                    </label>
                                    <input type="text" class="form-control" placeholder="Name author" id="name_author" name="name_author" required>
                                </div>
                                <div class="form-group form-upload-img-custom">
                                    <label>Avatar author</label>
                                    <input type="file" name="image-main-author" onchange="readAuthorAvatar(this);" required id="imgFeature-author" data-type="author">
                                    <img id="image-main-preview-author" class="img-upload-product hidden-class" src="#" alt="Ảnh" />
                                </div>
                                <div class="form-group">
                                    <label for="level_story">
                                        Chọn Level
                                    </label>
                                    <select class="form-control" id="level_story" name="level_story" >
                                        <option value="">Chon Level!</option>
                                        <?php
                                        foreach ($levels as $level):
                                            echo '<option value="' . $level->id . '">' . $level->level . '</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="genre_story">
                                        Chọn genre
                                    </label>
                                    <select class="form-control" id="genre_story" name="genre_story" >
                                        <option value="">Chon Genre!</option>
                                        <?php
                                        foreach ($genres as $genre):
                                            echo '<option value="' . $genre->id . '">' . $genre->genre . '</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="length_story">
                                        Length Story
                                    </label>
                                    <input type="text" class="form-control" placeholder="Length Story" id="length_story" name="length_story" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning btn-finish-new-story">
                                    Create
                                </button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="title_chapter">
                    Title chapter
                </label>
                <input type="text" class="form-control" placeholder="Title chapter" id="title_chapter" name="title_chapter" required>
            </div>
            <div class="form-group">
                <label for="order_chapter">
                    Order chapter
                </label>
                <input type="text" class="form-control" placeholder="Order chapter" id="order_chapter" name="order_chapter" required>
            </div>
            <div class="form-group">
                <label for="number_images_chapter">
                    Number Images Chapter
                </label>
                <input type="text" class="form-control" placeholder="Number Images Chapter" id="number_images_chapter" name="number_images_chapter" required>
            </div>
            <div class="form-group">
                <label for="content_chapter">
                    Nội dung
                </label>
                <textarea id="content_chapter" rows="10" cols="80" name="content_chapter"></textarea>
                <script>
                    CKEDITOR.replace( 'content_chapter' );
                </script>
            </div>
            <button type="button" class="btn btn-warning btn-create-new-chapter-of-story">
                Create chapter
            </button>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('public/js/admin/readingUploadNewEnglishStory.js')}}"></script>
@endsection

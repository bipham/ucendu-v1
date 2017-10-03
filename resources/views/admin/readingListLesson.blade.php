<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 8/17/2017
 * Time: 12:36 AM
 */

?>
@extends('layout.masterNoMenu')
@section('meta-title')
    Reading List Lesson
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/admin/readingListLesson.css')}}">
@endsection
@section('content')
    <div class="container reading-list-lesson-container">
        @include('utils.message')
        {{--@include('errors.input')--}}
        <table id="reading-list-lesson" class="table datatable">
            <thead>
                <tr>
                <th><label><input class="select-all-lessons" name="all-lessons" type="checkbox" value="all"> Chọn</label></th>
                <th>STT </th>
                <th>Ảnh đại diện </th>
                <th>Tiêu đề </th>
                <th>Thao tác </th>
            </tr>
            </thead>
            <tbody>
            @foreach($list_lessons as $key => $lesson)
                <tr class="item_row item-lesson-{!! $lesson->id !!}">
                    <td><input type="checkbox" name="item-lesson" value="{!! $lesson->id !!}"></td>
                    <td>{!! $key + 1 !!}</td>
                    <td>
                        <img class="rounded img-thumbnail img-feature-lesson" src="{{ asset('storage/upload/images/img-feature/' . $lesson->image_feature) }}" alt="{!! $lesson->title !!}" />
                    </td>
                    <td> {!! $lesson->title !!}</td>
                    <td>
                        <a href="{{url('editLessonReading/' . $lesson->id)}}">
                            <button type="button" class="btn btn-info btn-admin-custom btn-edit-lesson" data-id="{!! $lesson->id !!}" onclick="">Edit</button>
                        </a>
                        <button class="btn btn-warning btn-admin-custom btn-edit-info-basic-lesson" data-id="{!! $lesson->id !!}" data-toggle="modal" data-target="#editInfoBasicReadingLessonModal-{!! $lesson->id !!}">Edit Basic</button>
                        <button class="btn btn-danger btn-admin-custom btn-del-lesson" data-id="{!! $lesson->id !!}" onclick="deleteReadingLesson({!! $lesson->id !!})">Del</button>

                        <!-- Modal Edit Basic-->
                        <div class="modal fade" id="editInfoBasicReadingLessonModal-{!! $lesson->id !!}" tabindex="-1" data-id="{!! $lesson->id !!}" role="dialog" aria-labelledby="editInfoBasicReadingLessonModal" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="readingReviewQuizModalLabel">
                                            Edit basic lesson!
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" action="{!! url('updateInfoBasicReadingLesson') !!}" method="POST">
                                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                                            <div class="form-group">
                                                <label for="title-lesson-{!! $lesson->id !!}">
                                                    Tên Bài Viết
                                                </label>
                                                <input type="text" name="title-lesson-{!! $lesson->id !!}" class="form-control" placeholder="Điền vào đây" required id="titleLesson{!! $lesson->id !!}" value="{!! $lesson->title !!}">
                                            </div>
                                            <div class="form-group form-upload-img-custom">
                                                <label>Hình Đại Diện</label>
                                                <input type="file" name="image-main-{!! $lesson->id !!}" onchange="readURL(this);" required id="imgFeature{!! $lesson->id !!}" data-id="{!! $lesson->id !!}">
                                                <img id="image-main-preview-{!! $lesson->id !!}" class="img-upload-product" src="{{ asset('storage/upload/images/img-feature/' . $lesson->image_feature) }}" alt="Ảnh" />
                                            </div>
                                            <div class="form-group">
                                                <label for="list-level-{!! $lesson->id !!}">
                                                    Chon level!
                                                </label>
                                                <select class="form-control" id="list-level-{!! $lesson->id !!}" name="list-level-{!! $lesson->id !!}" >
                                                    @foreach ($all_levels as $all_level)
                                                            <option value="{!! $all_level->id !!}" @if($lesson->level_id == $all_level->id) selected="selected" @endif>{!! $all_level->level !!}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-save-info-basic btn-warning">
                                            Save
                                        </button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('public/js/admin/readingListLesson.js')}}"></script>
@endsection

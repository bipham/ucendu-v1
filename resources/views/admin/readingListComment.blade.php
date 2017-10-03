<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 8/18/2017
 * Time: 4:01 PM
 */
//dd($all_comments);
?>

@extends('layout.masterNoMenu')
@section('meta-title')
    Reading List Comment
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/admin/readingListComment.css')}}">
@endsection
@section('content')

    <div class="container reading-list-lesson-container">
        @include('utils.message')
        {{--@include('errors.input')--}}
        <table id="reading-list-comment" class="table datatable">
            <thead>
            <tr>
                <th><label><input class="select-all-comment" name="all-comments" type="checkbox" value="all"> Chọn</label></th>
                <th>STT </th>
                <th>User</th>
                <th>Nội dung bình luận</th>
                <th>Lesson</th>
                <th>Status</th>
                <th>Ngày đăng</th>
                <th>Thao tác </th>
            </tr>
            </thead>
            <tbody>
            @foreach($all_comments as $key => $comment_reading)
                <tr class="item-row item-comment-{!! $comment_reading['comment_id'] !!}" data-question-id="{!! $comment_reading['question_id'] !!}" data-reply-id="{!! $comment_reading['reply_id'] !!}">
                    <td><input type="checkbox" name="item-comment" value="{!! $comment_reading['comment_id'] !!}"></td>
                    <td>{!! $key + 1 !!}</td>
                    <td class="user-comment-preview">
                        <div class="img-auto-center user-comment-info thumbnail-outer-custom">
                            <img class="rounded img-thumbnail img-feature-user img-feature-custom img-thumbnail-inner" src="{{ asset('storage/img/users/' . $comment_reading['avatar_user']) }}" alt="{!! $comment_reading['username_cmt'] !!}" />
                            <span class="username-comment inline-class title-thumbnail-inner">
                                {!! $comment_reading['username_cmt'] !!}
                            </span>
                        </div>
                    </td>
                    <td class="content-comment-preview">
                        {!! $comment_reading['content_cmt'] !!}
                    </td>
                    <td class="lesson-comment-preview">
                        <div class="img-auto-center lesson-comment-info thumbnail-outer-custom">
                            <img class="rounded img-thumbnail img-feature-lesson img-feature-custom img-thumbnail-inner" src="{{ asset('storage/upload/images/img-feature/' . $comment_reading['image_lesson_feature']) }}" alt="{!! $comment_reading['lesson_title'] !!}" />
                            <span class="username-comment inline-class title-thumbnail-inner">
                                <a href="{{url('http://ucendu.dev/reading/readingViewSolutionLesson/' . $comment_reading['lesson_id'] . '-' . $comment_reading['quiz_id'] . '?question=' . $comment_reading['question_id_custom'] . '&comment=' . $comment_reading['comment_id'])}}">
                                    {!! $comment_reading['lesson_title'] !!}
                                </a>
                            </span>
                        </div>
                    </td>
                    <td class="status-comment-preview">
                        @if($comment_reading['private'] == 0)
                            <div class="badge badge-success status-comment">Public</div>
                        @else
                            <div class="badge badge-warning status-comment">Private</div>
                        @endif
                    </td>
                    <td class="time-ago-comment-preview">
                        {!! $comment_reading['noti_updated'] !!}
                    </td>
                    <td class="edit-comment-center">
                        <button type="button" class="btn btn-success btn-admin-custom btn-set-comment-public" data-id="{!! $comment_reading['comment_id'] !!}" data-question-id="{!! $comment_reading['question_id'] !!}" data-reply-id="{!! $comment_reading['reply_id'] !!}" onclick="setPublicReadingComment({!! $comment_reading['comment_id'] !!})" @if($comment_reading['private'] == 0) disabled @endif>Set public</button>
                        <button type="button" class="btn btn-warning btn-admin-custom btn-set-comment-private" data-id="{!! $comment_reading['comment_id'] !!}" data-question-id="{!! $comment_reading['question_id'] !!}" data-reply-id="{!! $comment_reading['reply_id'] !!}" onclick="setPrivateReadingComment({!! $comment_reading['comment_id'] !!})" @if($comment_reading['private'] == 1) disabled @endif>Set private</button>
                        <button type="button" class="btn btn-danger btn-admin-custom btn-del-lesson" data-id="{!! $comment_reading['comment_id'] !!}" data-question-id="{!! $comment_reading['question_id'] !!}" data-reply-id="{!! $comment_reading['reply_id'] !!}" onclick="deleteReadingComment({!! $comment_reading['comment_id'] !!})">Del</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('public/js/admin/readingListComment.js')}}"></script>
@endsection


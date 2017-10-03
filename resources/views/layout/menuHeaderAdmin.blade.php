<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 9/5/2017
 * Time: 1:56 PM
 */
?>
<div class="menu-fix-custom">
    <div class="container">
        <div class="menu menu-reading">
            <div class="pull-right action-user-center-fixed">
                @include('utils.actionCenterUser')
            </div>
            <ul class="nav nav-tabs" id="myTabReading" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/uploadReadingLesson')}}">New_Lesson</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/createNewTypeQuestion')}}">New_Learning</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/createNewVocabulary')}}">New_Vocabulary</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/createNewUser')}}">New_User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/listReadingLesson')}}">Manager_lesson</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/listCommentReading')}}">Manager_comment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/createNewLevelLesson')}}">New_level_lesson</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/createNewLevelStory')}}">New_level_story</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/createNewGenreStory')}}">New_genre_story</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/uploadReadingStory')}}">New_story</a>
                </li>
            </ul>
        </div>
    </div>
</div>

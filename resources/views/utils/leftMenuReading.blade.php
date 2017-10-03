<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 9/27/2017
 * Time: 11:40 PM
 */
?>

<div class="nav-side-menu">
    <div class="brand">Brand Logo</div>
    <div class="menu-list">
        <ul id="menu-content" class="menu-content">
            <?php
            $readingLessonModel = new  App\Models\ReadingTypeQuestion();
            $list_type_questions = $readingLessonModel->getAllTypeQuestionId();
//            dd($list_type_questions);
                foreach ($list_type_questions as $type_question) {
//                    dd($type_question);
                }
            ?>
            <li>
                <a href="#">
                    <i class="fa fa-dashboard fa-lg"></i> Dashboard - {!! $lesson_id !!}
                </a>
            </li>
            <li  data-toggle="collapse" data-target="#products" class="collapsed">
                <a href="#"><i class="fa fa-gift fa-lg"></i> UI Elements - {!! $level->level !!}<span class="arrow"></span></a>
            </li>
            <ul class="sub-menu collapse" id="products">
                <li data-toggle="collapse" data-target="#test" class="collapsed"><a href="#">CSS3 Test</a></li>
                <ul class="sub-menu collapse" id="test">
                    <li>New Service 1</li>
                    <li>New Service 2</li>
                    <li>New Service 3</li>
                </ul>
                <li><a href="#">General</a></li>
                <li><a href="#">Buttons</a></li>
                <li><a href="#">Tabs & Accordions</a></li>
                <li><a href="#">Typography</a></li>
                <li><a href="#">FontAwesome</a></li>
                <li><a href="#">Slider</a></li>
                <li><a href="#">Panels</a></li>
                <li><a href="#">Widgets</a></li>
                <li><a href="#">Bootstrap Model</a></li>
            </ul>
            <li data-toggle="collapse" data-target="#service" class="collapsed">
                <a href="#"><i class="fa fa-globe fa-lg"></i> Services <span class="arrow"></span></a>
            </li>
            <ul class="sub-menu collapse" id="service">
                <li>New Service 1</li>
                <li>New Service 2</li>
                <li>New Service 3</li>
            </ul>
            <li data-toggle="collapse" data-target="#new" class="collapsed">
                <a href="#"><i class="fa fa-car fa-lg"></i> New <span class="arrow"></span></a>
            </li>
            <ul class="sub-menu collapse" id="new">
                <li>New New 1</li>
                <li>New New 2</li>
                <li>New New 3</li>
            </ul>
            <li>
                <a href="#">
                    <i class="fa fa-user fa-lg"></i> Profile
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-users fa-lg"></i> Users
                </a>
            </li>
        </ul>
    </div>
</div>
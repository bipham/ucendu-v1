<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 7/18/2017
 * Time: 4:42 PM
 */
//var_dump($highest_result[1]);
?>
@extends('layout.master')
@section('meta-title')
    Welcome Ucendu
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/welcome.css')}}">
    <script src="{{asset('public/libs/modernizr/modernizr.js')}}"></script>
@endsection
@section('content')
    <section class="cd-section visible">
        @include('layout.menuHeaderReading')
        <div class="row-fluid outer-banner-home-custom outer-first-banner-home-custom img-banner-homepage-custom parallax">
            <div class="middle-banner-home-custom">
                <div class="welcome-homepage-custom inner-banner-home-custom">
                    <div class="title-welcome title-banner-home-custom">
                        CHÀO MỪNG BẠN ĐẾN VỚI
                    </div>
                    <div class="name-homepage-welcome name-banner-home-custom">
                        UCENDU
                    </div>
                    <div class="content-homepage content-banner-home-custom">
                        Đây là nơi bạn có thể học tập và ôn thi IELTS!
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cd-section">
        <div class="row-fluid outer-banner-home-custom img-banner-homepage-custom parallax">
            <div class="middle-banner-home-custom">
                <div class="welcome-homepage-custom inner-banner-home-custom">
                    <div class="title-welcome title-banner-home-custom">
                        GIỚI THIỆU
                    </div>
                    {{--<div class="name-store-welcome name-banner-custom">--}}
                        {{--UCENDU--}}
                    {{--</div>--}}
                    {{--<div class="content-store content-banner-custom">--}}
                        {{--Đây là nơi bạn có thể học tập và ôn thi IELTS!--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </section>

    <section class="cd-section">
        <div class="row-fluid outer-banner-home-custom img-banner-homepage-custom parallax">
            <div class="middle-banner-home-custom">
                <div class="welcome-homepage-custom inner-banner-home-custom">
                    <div class="title-welcome title-banner-home-custom">
                        PHƯƠNG PHÁP LỘ TRÌNH
                    </div>
                    {{--<div class="name-store-welcome name-banner-custom">--}}
                    {{--UCENDU--}}
                    {{--</div>--}}
                    {{--<div class="content-store content-banner-custom">--}}
                    {{--Đây là nơi bạn có thể học tập và ôn thi IELTS!--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </section>

    <section class="cd-section">
        <div class="row-fluid outer-banner-home-custom img-banner-homepage-custom parallax">
            <div class="middle-banner-home-custom">
                <div class="welcome-homepage-custom inner-banner-home-custom">
                    <div class="title-welcome title-banner-home-custom">
                        BẮT ĐẦU KHÓA HỌC
                    </div>
                    {{--<div class="name-store-welcome name-banner-custom">--}}
                    {{--UCENDU--}}
                    {{--</div>--}}
                    {{--<div class="content-store content-banner-custom">--}}
                    {{--Đây là nơi bạn có thể học tập và ôn thi IELTS!--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </section>

    <section class="cd-section">
        <div class="row-fluid outer-banner-home-custom img-banner-homepage-custom parallax">
            <div class="middle-banner-home-custom">
                <div class="welcome-homepage-custom inner-banner-home-custom">
                    <div class="title-welcome title-banner-home-custom">
                        TESTIMONIALS
                    </div>
                    {{--<div class="name-store-welcome name-banner-custom">--}}
                    {{--UCENDU--}}
                    {{--</div>--}}
                    {{--<div class="content-store content-banner-custom">--}}
                    {{--Đây là nơi bạn có thể học tập và ôn thi IELTS!--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </section>

    <nav>
        <ul class="cd-vertical-nav">
            <li><a href="#0" class="cd-prev inactive">Next</a></li>
            <li><a href="#0" class="cd-next">Prev</a></li>
        </ul>
    </nav> <!-- .cd-vertical-nav -->
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#myTabReading a.reading-practice').addClass('hidden');
            $('#myTabReading a.reading-intro').addClass('hidden');
            $('#myTabReading a.reading-test-quiz').addClass('hidden');
            $('#myTabReading a.reading-solution-quiz').addClass('hidden');
        })
    </script>
    <script src="{{asset('public/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('public/libs/velocity/velocity.min.js')}}"></script>
    <script src="{{asset('public/libs/velocity/velocity.ui.min.js')}}"></script>
    <script src="{{asset('public/js/welcome.js')}}"></script>
@endsection
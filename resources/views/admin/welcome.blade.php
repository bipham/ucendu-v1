<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 7/18/2017
 * Time: 4:42 PM
 */
//var_dump($highest_result[1]);
?>
@extends('layout.masterNoMenu')
@section('meta-title')
    Welcome Ucendu
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/welcome.css')}}">
    <script src="{{asset('public/libs/modernizr/modernizr.js')}}"></script>
    <style type="text/css">
        .menu-fix-custom {
            display: block;
        }
    </style>
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
<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 9/26/2017
 * Time: 12:00 AM
 */
//dd($practice_lessons);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>@yield('meta-title', 'Reading English') - Ucendu</title>
    <link rel="stylesheet" href="{{asset('public/libs/bootstrap/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('public/libs/font-awesome/css/font-awesome.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('public/css/client/readingLessonDetail.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/my-style.css')}}"/>
    <link rel="stylesheet" href="{{asset('public/css/client/readingFooterNavigation.css')}}"/>
    <link rel="stylesheet" href="{{asset('public/css/client/responsive.css')}}"/>
    <link rel="stylesheet" href="{{asset('public/libs/toolbar/jquery.toolbar.css')}}" />
    {{--<link rel="stylesheet" href="{{asset('public/libs/jcubic-splitter/css/jquery.splitter.css')}}" />--}}
    <script>
        var current_user = {!! json_encode(Auth::user()) !!};
        {{--var current_user_name = {!! json_encode((array)Auth::user()->id) !!};--}}
    </script>
    @yield('css')
</head>
<body data-hijacking="on" data-animation="parallax">
<a href="#" id="allownoti" class="hidden">Cho phép thông báo</a>
<a href="#" id="shownoti" class="hidden">Hiển thị thông báo</a>
<div class="overlay"></div>
<div id="loading"></div>
@include('layout.header')
@include('layout.menuHeaderReading')
<div role="main" class="main main-page">
    {{--@yield('banner-page')--}}
    @include('layout.tabContentReading')

    @yield('top-information')

    @yield('content')

</div>
@include('utils.toolbarReadingLesson')
@include('utils.leftMenuReading', ['level' => $level, 'lesson_id' => $lesson_id ])
@include('layout.footerNavigation')
<script src="{{asset('public/libs/tether/tether.min.js')}}"></script>
<script src="{{asset('public/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/libs/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/libs/highlight/TextHighlighter.min.js')}}"></script>
<script src="{{asset('public/libs/bootbox/bootbox.min.js')}}"></script>
<script src="{{asset('public/libs/splitter/jquery-resizable.js')}}"></script>
<script src="//cdn.rawgit.com/julmot/mark.js/master/dist/jquery.mark.min.js"></script>
<script src="{{asset('public/libs/toolbar/jquery.toolbar.js')}}"></script>
<script src="{{asset('public/js/my-script.js')}}"></script>
<script src="{{asset('public/js/client/readingFooterNavigation.js')}}"></script>
<script language="JavaScript">
    <!--
    var dictionaries = "ev_ve";
    // -->
</script>
<script language="JavaScript1.2" src="http://vndic.net/js/vndic.js" type='text/javascript'></script>
<script language="JavaScript">
    $('.btn-toolbar').toolbar({
        content: '#toolbar-options',
        position: 'right',
        style: 'primary',
        event: 'click'
    });

    var allownoti = document.getElementById('allownoti');
    var shownoti = document.getElementById('shownoti');

    // Thực hiện hành động bên trong khi nhấp vào Cho phép thông báo
    //        e.preventDefault();

    //        // Nếu trình duyệt không hỗ trợ thông báo
    //        if (!window.Notification)
    //        {
    //            alert('Trình duyệt của bạn không hỗ trợ chức năng này.');
    //        }
    //        // Ngược lại trình duyệt có hỗ trợ thông báo
    //        else
    //        {
    // Gửi lời mời cho phép thông báo
    Notification.requestPermission(function (p) {
        // Nếu không cho phép
        if (p === 'denied')
        {
//                    Notification.requestPermission = 'granted';
//                    alert('Bạn đã không cho phép thông báo trên trình duyệt.');
        }
        // Ngược lại cho phép
        else
        {
//                    alert('Bạn đã cho phép thông báo trên trình duyệt!');
        }
    });
    //        }

</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
<script src="{{asset('public/js/socketNoti.js')}}"></script>
@yield('scripts')
</body>
</html>

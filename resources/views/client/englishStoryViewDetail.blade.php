<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 9/7/2017
 * Time: 3:30 PM englishStoryViewDetail.blade
 */
?>
@extends('layout.masterNoFooter')
@section('meta-title')
    English-story - UCENDU
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('public/libs/media-element-player/src/mediaelementplayer.min.css')}}">
    {{--<link rel="stylesheet" href="{{asset('public/libs/media-element-player/src/jump-forward/jump-forward.css')}}">--}}
    {{--<link rel="stylesheet" href="{{asset('public/libs/media-element-player/src/skip-back/skip-back.css')}}">--}}
    {{--<link rel="stylesheet" href="{{asset('public/libs/media-element-player/src/speed/speed.css')}}">--}}
    {{--<link rel="stylesheet" href="{{asset('public/libs/media-element-player/src/chromecast/chromecast.css')}}">--}}
    {{--<link rel="stylesheet" href="{{asset('public/libs/media-element-player/src/context-menu/context-menu.css')}}">--}}
    <link rel="stylesheet" href="{{asset('public/libs/media-element-player/src/mep-feature-playlist.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/client/viewStoryDetail.css')}}">
    <?php
    $bg = array('1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg', '9.jpg', '10.jpg', '11.jpg', '12.jpg', '13.jpg', '14.jpg', '15.jpg');
    $i = rand(0, count($bg)-1); // generate random number size of the array
    $i2 = rand(0, count($bg)-1); // generate random number size of the array
    $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen
    $selectedBg2 = "$bg[$i2]"; // set variable equal to which random filename was chosen
    ?>
    <style type="text/css">
        .outer-banner-custom {
            background: url(/public/imgs/background-header/<?php echo $selectedBg2; ?>);
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            margin-bottom: 80px;
            height: 400px;
        }

        .header-product {
            background: url(/public/imgs/background-header/<?php echo $selectedBg; ?>);
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
    <script src="{{asset('public/libs/within-viewport/withinviewport.js')}}"></script>
@endsection
@section('titleTypeLesson')
    {!! $story->title !!}
@endsection
@section('content')
    <div class="row-fluid outer-banner-custom">
        <div class="breadcrumb-header middle-banner-custom">
            <div class="content-breadcrumb-header content-banner-custom">
                <div class="title-story-overview">
                    <i class="icon-story-custom fa fa-book" aria-hidden="true"></i>
                    <h2 class="title-post">{!! $story->title !!}</h2>
                </div>
                <div class="info-story">
                    <div class="info-level basic-story-info">
                        <span class="title-info-basic">
                            Level:
                        </span>
                        <span class="level-story info-detail-story">
                            {!! $level !!}
                        </span>
                    </div>
                    <div class="info-genre basic-story-info">
                        <span class="title-info-basic">
                            Genre:
                        </span>
                        <span class="genre-story info-detail-story">
                            {!! $genre !!}
                        </span>
                    </div>
                    <div class="info-length basic-story-info">
                        <span class="title-info-basic">
                            Length:
                        </span>
                        <span class="length-story info-detail-story">
                            {!! $story->length !!}
                        </span>
                    </div>
                </div>
                <div class="author-info basic-story-info">
                        <span class="author-avatar">
                            <img class="img-author" src="{{ asset('storage/upload/reading-stories/' . $story->id . '-' . $story->title . '/author-avatar/' . $story->avatar_author) }}" alt="{!! $story->author !!}" />
                        </span>
                    <span class="author-name">
                            {!! $story->author !!}
                        </span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 list-chapters">
                <div class="title-list-chapters">
                    <a class="cover-story-link" href="#cover-story">
                        {!! $story->title !!}
                    </a>
                </div>
                <div class="inner-content-list-chapters">
                    @foreach($chapters as $chapter)
                        <div class="link-to-chapter">
                            <a class="chapter-story-link" href="#chapter-{!! $chapter->order_chapter !!}" data-chapter-id="{!! $chapter->order_chapter !!}" onclick="playChapter({!! $chapter->order_chapter !!});">
                                {!! $chapter->order_chapter !!}. {!! $chapter->title_chapter !!}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6 reading-view-story">
                <div class="reading-view">
                    <div class="content-story">
                        <div class="content-viewport">
                            <div class="cover-page" id="cover-story">
                                <img class="img-cover" src="{{ asset('storage/upload/reading-stories/' . $story->id . '-' . $story->title . '/image-cover/' . $story->image_cover) }}" alt="{!! $story->title !!}" />
                            </div>
                            @foreach($chapters as $chapter)
                                <div id="chapter-{!! $chapter->order_chapter !!}" class="chapter-story" data-order-chapter="{!! $chapter->order_chapter !!}">
                                    <div class="title-chapter-area">
                                        <h3 class="order-chapter">
                                            CHAPTER {!! $chapter->order_chapter !!}
                                        </h3>
                                        <h2 class="title-chapter">
                                            {!! $chapter->title_chapter !!}
                                        </h2>
                                    </div>
                                    <div class="content-chapter">
                                        {!! $chapter->content_chapter !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 list-download-story">

            </div>
        </div>
    </div><!-- /container -->
    <div class="row-fluid player-area">
        <div class="players" id="player-container">
            <div class="media-wrapper">
                <audio id="player-story" preload="auto" autoplay controls="controls" style="max-width:100%;">
                    @foreach($chapters as $chapter)
                        <source src="{!! $chapter->audio_link !!}" type="audio/mp3" title="{!! $chapter->order_chapter !!}. {!! $chapter->title_chapter !!}" >
                    @endforeach
                </audio>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('public/libs/media-element-player/src/mediaelement-and-player.min.js')}}"></script>
    {{--<script src="{{asset('public/libs/media-element-player/src/jump-forward/jump-forward.js')}}"></script>--}}
    {{--<script src="{{asset('public/libs/media-element-player/src/skip-back/skip-back.js')}}"></script>--}}
    {{--<script src="{{asset('public/libs/media-element-player/src/speed/speed.js')}}"></script>--}}
    {{--<script src="{{asset('public/libs/media-element-player/src/chromecast/chromecast.js')}}"></script>--}}
    {{--<script src="{{asset('public/libs/media-element-player/src/context-menu/context-menu.js')}}"></script>--}}
    <script src="{{asset('public/libs/media-element-player/src/mep-feature-playlist.js')}}"></script>
    <script src="{{asset('public/js/client/viewStoryDetail.js')}}"></script>
    <script>
        $(function () {
            $('#myTabReading a.reading-intro').addClass('hidden');
            $('#myTabReading a.reading-test-quiz').addClass('hidden');
            $('#myTabReading a.reading-practice').addClass('hidden');
            $('#myTabReading a.reading-solution-quiz').addClass('hidden');
            $('#myTabReading a.reading-test-lesson').addClass('hidden');
        })
    </script>
    <script>
        var features = ['playlistfeature', 'prevtrack', 'playpause', 'nexttrack', 'loop', 'shuffle', 'playlist', 'current', 'progress', 'duration', 'volume'];
        $('audio').mediaelementplayer({
            loop: true,
            shuffle: true,
            playlist: true,
            audioHeight: 30,
            autoPlay: true,
            playlistposition: 'top',
            features: features,
//                showPlaylist: false,
            autoClosePlaylist: true,
            currentMessage: 'Now playing:'
        });
    </script>
@endsection

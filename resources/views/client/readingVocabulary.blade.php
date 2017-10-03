<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 7/18/2017
 * Time: 4:42 PM
 */
//var_dump($highest_result[1]);
//dd($all_vocabulary);
?>
@extends('layout.masterNoFooter')
@section('meta-title')
    Vocabulary Reading
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/client/readingNavtabsVertical.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/client/readingVocabulary.css')}}">
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
            margin-bottom: 10px;
            /*height: 130px;*/
        }

        .header-product {
            background: url(/public/imgs/background-header/<?php echo $selectedBg; ?>);
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
@endsection
@section('titleTypeLesson')
    VOCABULARY
@endsection
@section('content')
    <div class="row-fluid outer-banner-custom">
        <div class="breadcrumb-header middle-banner-custom">
            <div class="content-breadcrumb-header content-banner-custom">
                <h2 class="title-post">VOCABULARY</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <ul class="nav nav-tabs nav-tabs-vertical-custom flex-column col-md-2 nav-tabs-all-vocabulary" id="myTabVocabulary" role="tablist">
                @foreach($all_vocabularies as $vocabulary)
                    <li class="nav-item nav-item-vertical-tab-custom tab-vocabulary-control">
                        <a class="nav-link nav-link-vocabulary vocabulary-{!! $vocabulary->id !!}" data-toggle="tab" href="#vocabulary{!! $vocabulary->id !!}" role="tab">
                            <div class="icon-type-voca icon-section-custom">
                                <i class="fa {!! $vocabulary->icon !!}" aria-hidden="true"></i>
                            </div>
                            <div class="name-type-voca title-section-custom">
                                {!! $vocabulary->name !!}
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
            <!-- Tab panes -->
            <?php
            $readingPhraseWordVocabularyModel = new App\Models\ReadingPharseWordVocabulary();
            ?>
            <div class="tab-content col-md-10 content-vocabulary-area tab-content-area-custom">
                @foreach($all_vocabularies as $vocabulary)
                    <?php
                    $all_phrase_words = $readingPhraseWordVocabularyModel->getAllPhraseWordByVocabularyId($vocabulary->id);
                    $index_phrase_word = 1;
                    ?>
                    @if(sizeof($all_phrase_words) > 0 )
                        <div class="tab-pane tab-pane-vocabulary tab-pane-vocabulary-{!! $vocabulary->id !!}" id="vocabulary{!! $vocabulary->id !!}" role="tabpanel">
                            <ul class="nav nav-tabs flex-column col-md-8 nav-tabs-vocabulary nav-tabs-vocabulary-{!! $vocabulary->id !!}">
                                @foreach($all_phrase_words as $phrase_word)
                                    <li class="nav-item tab-phrase-word-control">
                                        <a class="nav-link nav-link-phrase-word phrase-word-{!! $phrase_word->id !!}" data-toggle="tab" href="#phraseWord{!! $phrase_word->id !!}" role="tab">
                                            <div class="name-phrase-word">
                                                {!! $index_phrase_word !!}. {!! $phrase_word->phrase_word !!}
                                            </div>
                                        </a>
                                    </li>
                                    <?php
                                    $index_phrase_word += 1;
                                    ?>
                                @endforeach
                            </ul>
                            <div class="tab-content col-md-4 content-phrase-word-area">
                                @foreach($all_phrase_words as $phrase_word)
                                    <div class="tab-pane tab-pane-phrase-word tab-pane-phrase-word-{!! $phrase_word->id !!}" id="phraseWord{!! $phrase_word->id !!}" role="tabpanel">
                                        <div class="title-content-phrase-word">
                                            DEFINITION
                                        </div>
                                        <div class="inner-content-phrase-word">
                                            {!! $phrase_word->content !!}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{--<div class="container content-vocabulary">--}}
                                {{--{!! $vocabulary->content !!}--}}
                            {{--</div>--}}
                        </div>
                    @endif
                @endforeach
            </div>
        </div><!-- /row -->
    </div><!-- /container -->
@endsection
@section('scripts')
    <script src="{{asset('public/js/client/readingVocabulary.js')}}"></script>
    <script>
        $(function () {
            $('#myTabReading a.reading-intro').addClass('hidden');
            $('#myTabReading a.reading-test-quiz').addClass('hidden');
            $('#myTabReading a.reading-practice').addClass('hidden');
            $('#myTabReading a.reading-solution-quiz').addClass('hidden');
            $('#myTabReading a.reading-test-lesson').addClass('hidden');
        })
    </script>
@endsection
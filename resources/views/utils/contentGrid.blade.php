<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 7/18/2017
 * Time: 4:45 PM
 */
?>
<div class="card col-xs-6 col-md-3 lesson-item">
    <div class="card-top-thumbnail img-thumbnail-middle">
        <div class="img-thumbnail-inner">
            <img class="img-middle-responsive" src="{{ asset('storage/upload/images/img-feature/' . $lesson->image_feature) }}" alt="IELTS">
        </div>
        <div class="frame-hover-lesson w3-animate-top  @if ($highest_result_reading != 99999) frame-result-reading @endif">
            <div class="over-view-lesson">
                @if ($highest_result_reading != 99999)
                    <div class="highest-result-over-view">
                        <h5 class="title-highest-result-ov">
                            Highest correct:
                        </h5>
                        <span class="number-highest-correct-ov badge badge-danger">
                           {!! $highest_result_reading !!}/{!! $lesson->total_questions !!}
                        </span>
                    </div>
                @endif
                <div class="total-question-over-view">
                    <h5 class="title-total-question-ov inline-class">
                        Total questions:
                    </h5>
                    <span class="pull-right number-total-ov badge badge-success inline-class">
                       {!! $lesson->total_questions !!}
                    </span>
                </div>
                <div class="detail-number-type-over-view">
                    <ul class="list-type-question-ov">
                        @foreach($detailTypeQuestionOfQuiz as $detailTypeQuestion)
                            <li class="type-question-ov">
                                <h6 class="title-type-question-ov inline-class">
                                    {!! $detailTypeQuestion->name !!}
                                </h6>
                                <span class="number-type-ov badge badge-primary inline-class pull-right">
                                    {!! $detailTypeQuestion->total_questions !!}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="card-block card-body-product">
        <div class="name-lesson">
            <?php
                $title_lesson = str_replace(" ","-", $lesson->title);
            ?>
            <a href="{{url('reading/readingLesson/lesson' . $lesson->lesson_id . '-' . $title_lesson)}}">
                <h4 class="card-title title-lesson">{!! $lesson->title !!}</h4>
            </a>
        </div>
        <div class="info-cate-time-lesson">
            <span class="card-cate-lesson pull-left">
                <a href="#">{!! $lesson->name !!}</a>
            </span>
            <span class="time-ago-lesson pull-right">
                <?php
                    $time_ago = timeago($lesson->created_at);
                ?>
                {!! $time_ago !!}
            </span>
        </div>
        <div class="btn-lesson-overview-area">
            <span class="btn-inline">
                <a href="{{url('reading/readingLesson/lesson' . $lesson->lesson_id . '-' . $title_lesson)}}" class="btn btn-outline-primary btn-test-overview">
                   <i class="fa fa-play" aria-hidden="true"></i>
                    Take Test
                </a>
            </span>
            <span class="btn-inline">
                <a href="{{url('reading/readingViewSolutionLesson/' . $lesson->lesson_id . '-' . $quiz_id)}}" class="btn btn-outline-success btn-test-overview">
                    <i class="fa fa-key" aria-hidden="true"></i>
                    Solution
                </a>
            </span>
        </div>
        @if($lesson->limit_time > 0)
            <div class="limit-time-overview">
                {!! $lesson->limit_time/60 !!} mins
            </div>
        @endif
    </div>
    <div class="card-footer card-footer-product">
        <span class="type-lesson-overview pull-left">
            @if ($lesson->type_lesson == 1)
                <?php
                $title_type_question = str_replace(" ","-", $detailTypeQuestionOfQuiz[0]->name);
                ?>
                <span class="badge badge-success type-lesson-header">
                    <a class="type-lesson-link" href="{{url('reading/readingTypeQuestion/typeQuestion' . $detailTypeQuestionOfQuiz[0]->id . '-' . $title_type_question)}}">
                        {!! $detailTypeQuestionOfQuiz[0]->name !!}
                    </a>
                </span>
            @elseif ($lesson->type_lesson == 2)
                <span class="badge badge-warning type-lesson-header">
                    <a class="type-lesson-link" href="{{url('reading/readingTypeLesson/typeLesson2-mix-test')}}">
                        Mix Test
                    </a>
                </span>
            @elseif ($lesson->type_lesson == 3)
                <span class="badge badge-danger type-lesson-header">
                    <a class="type-lesson-link" href="{{url('reading/readingTypeLesson/typeLesson3-full-test')}}">
                        Full Test
                    </a>
                </span>
            @endif
        </span>
        <span class="btn-download-lesson pull-right">
            <a href="#" class="download-lesson">
                <i class="fa fa-download" aria-hidden="true"></i>
            </a>
        </span>
    </div>
</div>
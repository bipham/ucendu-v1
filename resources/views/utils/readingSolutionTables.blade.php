<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 8/10/2017
 * Time: 5:11 PM
 */
?>

<div class="overview-solution-detail-section">
    <h2 class="title-overview-solution-section">
        Your Exam Performance
    </h2>
    <div class="align-center reading-score-overview">
        <div class="progress reading-solution-score-progress">
            <?php
                $number_correct = sizeof($correct_answers);
                $percent_correct = $number_correct/($lesson_quiz->total_questions);
                $percent_friendly = number_format( $percent_correct * 100, 0 );
                if ($list_answered == 'emptyList') {
                    $answered_number = 0;
                }
                else {
                    $answered_number = count((array)$list_answered);
                }
                $unanswered_number = $lesson_quiz->total_questions - $answered_number;
                $incorrect_number = $lesson_quiz->total_questions - $unanswered_number - $number_correct;
            ?>
            <div class="progress-bar bg-success reading-score-progress" style="width: {!! $percent_friendly !!}%" role="progressbar" aria-valuenow="{!! $percent_friendly !!}" aria-valuemin="0" aria-valuemax="100">
                {!! $percent_friendly !!}% Correct
            </div>
        </div>
    </div>
    <div class="row reading-score-detail">
        <div class="col-md-4 left-detail-score">
            <div class="stats-block stats-total-question">
                <span class="stats-value">{!! $lesson_quiz->total_questions !!}</span>
                <span class="stats-title">Total Questions</span>
            </div>
            <div class="stats-block stats-correct">
                <span class="stats-value">{!! $number_correct !!}</span>
                <span class="stats-title">Correct</span>
            </div>
        </div>
        <div class="col-md-4 center-detail-score">
            <div class="stats-block stats-unanswered">
                <span class="stats-value">{!! $unanswered_number !!}</span>
                <span class="stats-title">Unanswered</span>
            </div>
            <div class="stats-block stats-incorrect">
                <span class="stats-value">{!! $incorrect_number !!}</span>
                <span class="stats-title">Incorrect</span>
            </div>
        </div>
        <div class="col-md-4 right-detail-score">
            <canvas id="myChartReadingScore"></canvas>
        </div>
    </div>
    <div class="answered-table">
        <h4 class="title-answer-table">
            List answered detail
        </h4>
        <div class="row list-answered">
            @for($i=1; $i < $lesson_quiz->total_questions + 1; $i++)
                <div class="col-md-4 answered-score answered-score-{!! $i !!}" data-qorder="{!! $i !!}">
                    <div class="input-group question-table question-table-{!! $i !!}">
                        <span class="input-group-addon question-table-name">Q.{!! $i !!}</span>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-outline-secondary btn-show-answered show-answered-{!! $i !!}" data-qorder="{!! $i !!}">
                                <div class="your-choice-key-area">
                                    <div class="name-answered name-answered-{!! $i !!}">
                                        No choice
                                    </div>
                                    <div class="badge badge-primary badge-pill view-key-answer view-your-choice-{!! $i !!}">
                                        -
                                    </div>
                                </div>
                                <div class="icon-result">
                                    <i class="fa selected-false-icon fa-times-circle-o" aria-hidden="true"></i>
                                    <i class="fa selected-true-icon fa-check-circle-o hidden" aria-hidden="true"></i>
                                </div>
                                <div class="solution-key-area">
                                    <div class="solution-key-title">
                                        Answer
                                    </div>
                                    <div class="badge badge-warning badge-pill view-key-answer view-solution-question-{!! $i !!}">
                                        -
                                    </div>
                                </div>
                            </button>
                        </span>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
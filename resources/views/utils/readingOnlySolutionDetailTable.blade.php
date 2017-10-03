<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 8/16/2017
 * Time: 3:47 PM
 */
?>
<div class="overview-solution-detail-section">
    <div class="answered-table">
        <h4 class="title-answer-table">
            List solutions
        </h4>
        <div class="row list-answered">
            @for($i=1; $i < $lesson_quiz->total_questions + 1; $i++)
                <div class="col-md-2 answered-score answered-score-{!! $i !!}" data-qorder="{!! $i !!}">
                    <div class="input-group question-table question-table-{!! $i !!}">
                        <span class="input-group-addon question-table-name">
                            Q.{!! $i !!}
                        </span>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-outline-secondary btn-show-answered show-answered-{!! $i !!}" data-qorder="{!! $i !!}">
                                <div class="badge badge-warning badge-pill view-key-answer view-solution-question-{!! $i !!}">
                                    B
                                </div>
                            </button>
                        </span>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>

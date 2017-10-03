<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 8/9/2017
 * Time: 12:37 PM
 */
?>
<div class="reading-tool-lesson-quiz hidden">
    <button type="button" class="btn btn-danger btn-tool-sidebar btn-submit-modal btn-custom" data-toggle="modal" data-target="#readingSubmitQuizModal">
        Submit
        <i class="fa fa-paper-plane icon-reading-tool-sidebar" aria-hidden="true"></i>
    </button>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-tool-sidebar btn-review-quiz btn-custom" data-toggle="modal" data-target="#readingReviewQuizModal">
        Review
        <i class="fa fa-info icon-reading-tool-sidebar" aria-hidden="true"></i>
    </button>

    <a href="{{url('/reading/readingViewSolutionLesson/' . $lesson_detail->id . '-' . $lesson_quiz->id)}}" class="btn btn-success btn-tool-sidebar  btn-test-overview">
        Solution
        <i class="fa fa-key icon-reading-tool-sidebar" aria-hidden="true"></i>
    </a>
</div>

<!-- Modal Review-->
<div class="modal fade" id="readingReviewQuizModal" tabindex="-1" role="dialog" aria-labelledby="readingReviewQuizModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="readingReviewQuizModalLabel">
                    Review your answers
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="note-review">
                    * This window is to review your answers only, you cannot change the answers in here
                </p>

                <div class="container-fluid">
                    <div class="row row-review-answer">
                        @for($i = 1; $i <= $lesson_quiz->total_questions; $i++)
                            <div class="col-md-3 review-question-quiz review-question-<?php echo $i; ?>">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button class="btn btn-info btn-focus-question btn-focus-question-<?php echo $i; ?>" onclick="focusQuestion(<?php echo $i; ?>)" type="button">Q<?php echo $i; ?></button>
                                    </span>
                                    <input type="text" class="form-control answered-question-review answered-question-<?php echo $i; ?>" disabled />
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Submit  btn-submit-quiz -->
<div class="modal fade" id="readingSubmitQuizModal" tabindex="-1" role="dialog" aria-labelledby="readingSubmitQuizModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="readingSubmitQuizModal">
                    Are you sure want to submit?
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="title-auto-submit submit-manual">
                    You answered
                    <span class="result-test">
                        0/0
                    </span>
                    questions
                </h5>
                <button type="submit" class="btn btn-outline-danger btn-submit-quiz btn-custom">
                    Submit and review solution
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
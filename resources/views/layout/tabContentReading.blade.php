<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 8/9/2017
 * Time: 9:39 AM
 */
?>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane" id="readingIntro" role="tabpanel">
        @yield('banner-page')
        <div class="container introduction-container">
            @yield('readingIntro')
        </div>
    </div>
    <div class="tab-pane" id="practice" role="tabpanel">
        @yield('readingPractice')
    </div>
    <div class="tab-pane" id="readingTestLesson" role="tabpanel">
        @yield('readingTest')
    </div>
    <div class="tab-pane" id="readingTestQuiz" role="tabpanel">
        @yield('readingTestQuiz')
    </div>
    <div class="tab-pane" id="readingSolutionQuiz" role="tabpanel">
        @yield('readingSolutionQuiz')
    </div>
</div>

/**
 * Created by BiPham on 8/17/2017.
 */
var baseUrl = document.location.origin;
var mainUrl = baseUrl.substring(13);
var content_lesson_source = '';
var lesson_id = $('.upload-page-custom').data('lesson-id');
var quiz_id = $('.upload-page-custom').data('quiz-id');
console.log('lesson: ' + lesson_id);
console.log('quiz: ' + quiz_id);
var ajaxUpdateContentLessonReading = baseUrl + '/updateContentLessonReading/' + lesson_id;
var content_highlight_lesson = '';

var content_quiz = '';
var type_lesson = '';
var listQ = [];
var content_answer_quiz ='';
var listClassKeyword = {};
var listAnswer = {};
var listKeyword = {};
var list_type_questions = {};
var listAnswer_source = {};
var listKeyword_source = {};
var list_type_questions_source = {};
var ajaxUpdateQuizReadingReading = baseUrl + '/updateQuizReading/' + quiz_id;

var option_list_questions = '';
var ajaxGetListTypeQuestion = baseUrl + '/getTypeQuestion';
var list_type_old = [];
var list_Q_old = [];

$('.btn-edit-content-lesson').click(function () {
   $('.preview-lesson').toggleClass('hidden');
   $('.edit-content-lesson').toggleClass('hidden');
    content_lesson_source = CKEDITOR.instances["contentLesson"].getData().trim();
});

$('.btn-edit-quiz-lesson').click(function () {
   $('.preview-lesson').toggleClass('hidden');
   $('.edit-quiz-lesson').toggleClass('hidden');
   type_lesson = $('#typeLesson').val();
    $.ajax({
        type: "GET",
        url: ajaxGetListTypeQuestion,
        dataType: "json",
        success: function (data) {
            jQuery.each( data.list_type_questions, function( index_list_type_question, list_type_question ) {
                option_list_questions += '<option value="' + list_type_question.id + '">' + list_type_question.name + '</option>';
            });
        },
        error: function (data) {
            bootbox.alert({
                message: "FAIL TYPE QUESTIONS!",
                backdrop: true
            });
        }
    });
    $('#solution-area .question-quiz').each(function () {
        var qnumber = $(this).data('qnumber');
        if (jQuery.inArray(qnumber, listAnswer_source) == -1) {
            listAnswer_source[qnumber] = $('.explain-area-' + qnumber + ' .key-answer').html();
            listKeyword_source[qnumber] = $('#keywordArea-' + qnumber + ' .keywords-area').html();
            if (listKeyword_source[qnumber] == 'No_keywords') {
                listClassKeyword[qnumber] = 'hidden-class';
                listKeyword_source[qnumber] = '';
            }
            else {
                listClassKeyword[qnumber] = '';
            }
            if (jQuery.inArray(qnumber, list_Q_old) == -1) {
                list_type_questions_source[qnumber] = $('.explain-area-' + qnumber).data('type-question');
                list_type_old.push(list_type_questions_source[qnumber]);
                list_Q_old.push(qnumber);
            }
        }
    });
});

$( document ).ready(function() {
    //Edit Content
    $('.btn-next-edit-highlight').click(function () {
        // CKEDITOR.instances["contentLessonEditor"].setData(content_lesson_source);
        if (content_lesson_source != CKEDITOR.instances["contentLesson"].getData().trim()) {
            content_lesson_source = CKEDITOR.instances["contentLesson"].getData().trim();
            $('.remove-highlight-area').html('');
            $('#sandbox').html(content_lesson_source);
        }
        else {
            $('.remove-highlight-area').html('');
            $('#sandbox .answer-highlight').each(function () {
                $(this).removeClass('hidden-highlight');
                var class_highlight_order = $(this)[0].classList[1].match(/\d+/);
                if ($('.remove-ans-' + class_highlight_order[0] ).length == 0 ) {
                    $('.remove-highlight-area').append('' +
                        '<div class="remove-ans-' + class_highlight_order[0] + '">Remove highlight for anwser ' + class_highlight_order[0] + ': <button class="btn btn-info remove" data-removeid="' + class_highlight_order[0] + '">Remove</button></div>'
                    );
                }
            });
        }
        $('.edit-highlight').toggleClass('hidden');
        $('.edit-content').toggleClass('hidden');
        console.log(content_lesson_source);
    });

    $('.btn-back-edit-content').click(function () {
        $('.edit-highlight').toggleClass('hidden');
        $('.edit-content').toggleClass('hidden');
    });

    $('.btn-save-edit-lesson').click(function () {
        $('#sandbox .answer-highlight').addClass('hidden-highlight');
        content_highlight_lesson = $('#sandbox').html();
        $.ajax({
            type: "POST",
            url: ajaxUpdateContentLessonReading,
            dataType: "json",
            data: { 'content_highlight_lesson': content_highlight_lesson, 'content_lesson_source': content_lesson_source},
            success: function (data) {
                bootbox.alert({
                    message: "Update lesson success! " + data.result,
                    backdrop: true,
                    callback: function(){
                        location.href= baseUrl + '/editLessonReading/' + data.result;
                    }
                });
            },
            error: function (data) {
                bootbox.alert({
                    message: "Update lesson fail!",
                    backdrop: true
                });
            }
        });
    });

    //Edit Quiz
    $('.btn-next-edit-answer').click(function () {
        // content_quiz = CKEDITOR.instances["quizLesson"].getData().trim();
        console.log('list answer: ' + JSON.stringify(listAnswer_source));
        console.log('listKeyword_source: ' + JSON.stringify(listKeyword_source));
        console.log('list_type_questions_source: ' + JSON.stringify(list_type_questions_source));
        var checkDataStepQuiz = checkStepQuiz();
        console.log('type Lesson: ' + type_lesson);
        if (checkDataStepQuiz) {
            if ((content_quiz != CKEDITOR.instances["quizLesson"].getData()) || (type_lesson != $('#typeLesson').val()) ) {
                content_quiz = CKEDITOR.instances["quizLesson"].getData();
                type_lesson = $('#typeLesson').val();
                $('.preview-content-quiz .card-block').html(content_quiz);
                $('.answer-area').html('');
                $('.type-only-question-area').html('');
                listQ = [];
                if (type_lesson == 1) {
                    $('.type-only-question-area').append(   '<div class="form-group">' +
                        '<label for="select-type-question-only"><strong>Chọn Loai cau hoi</strong></label> ' +
                        '<select class="form-control" id="onlyTypeQuestion" name="select-type-question-only" > ' +
                        '<option value="">Chọn Loai cau hoi!</option> ' +
                        option_list_questions +
                        '</select> ' +
                        '</div>');
                }
                $('.preview-content-quiz .card-block .question-quiz').each(function () {
                    var qnumber = $(this).data('qnumber');
                    if (jQuery.inArray(qnumber, listQ) == -1) {
                        listQ.push(qnumber);
                        var qorder = $(this).attr('name');
                        qorder = qorder.match(/\d+/);
                        if (type_lesson == 1) {
                            $('.answer-area').append(   '<div class="answer-key answer-enter-' + qnumber + '" data-qnumber="' + qnumber + '">' +
                                '<h5 class="title-answer-for-question title-custom">Question ' + qorder + ':</h5>' +
                                '<div class="enter-answer-key row-enter-custom">' +
                                '<div class="title-row-enter">Answer ' + qorder + ': </div>' +
                                '<input class="answer-q answer-' + qorder + '" data-qnumber="' + qnumber + '" />' +
                                '</div>' +
                                '<div class="enter-keyword row-enter-custom">' +
                                '<div class="title-row-enter">Keyword ' + qorder + ': </div>' +
                                '<textarea class="input-keyword keyword-' + qorder + '" data-qnumber="' + qnumber + '"></textarea>' +
                                '</div>' +
                                '</div>');
                        }
                        else {
                            $('.answer-area').append(   '<div class="answer-key answer-enter-' + qnumber + '" data-qnumber="' + qnumber + '">' +
                                '<h5 class="title-answer-for-question title-custom">Question ' + qorder + ':</h5>' +
                                '<div class="enter-answer-key row-enter-custom">' +
                                '<div class="title-row-enter">Answer ' + qorder + ': </div>' +
                                '<input class="answer-q answer-' + qorder + '" data-qnumber="' + qnumber + '" />' +
                                '</div>' +
                                '<div class="enter-keyword row-enter-custom">' +
                                '<div class="title-row-enter">Keyword ' + qorder + ': </div>' +
                                '<textarea class="input-keyword keyword-' + qorder + '" data-qnumber="' + qnumber + '"></textarea>' +
                                '</div>' +
                                '<div class="enter-type-question row-enter-custom">' +
                                '<label for="select-type-question-' + qnumber + '" data-qnumber="' + qnumber + '"><strong>Chọn Loai cau hoi</strong></label> ' +
                                '<select class="form-control sl-type-question-' + qorder + '" data-qnumber="' + qnumber + '" name="select-type-question-' + qnumber + '"> ' +
                                '<option value="">Chọn Loai cau hoi!</option> ' +
                                option_list_questions +
                                '</select> ' +
                                '</div>' +
                                '</div>');
                        }
                    }
                    if (jQuery.inArray(qnumber, listAnswer_source) == -1) {
                        $('input.answer-q[data-qnumber=' + qnumber + ']').val(listAnswer_source[qnumber]);
                        $('textarea.input-keyword[data-qnumber=' + qnumber + ']').val(listKeyword_source[qnumber]);
                        $('.enter-type-question select[data-qnumber=' + qnumber + ']').val(list_type_questions_source[qnumber]);
                    }
                });
            }
            console.log('listQ: ' + listQ);
            if (listQ.length > 0) {
                $('.edit-quiz').toggleClass('hidden');
                $('.edit-answer').toggleClass('hidden');
            }
            else {
                bootbox.alert({
                    message: "Please enter question of quiz!",
                    backdrop: true
                });
            }
        }
    });

    $('.btn-back-edit-quiz').click(function () {
        $('.edit-quiz').toggleClass('hidden');
        $('.edit-answer').toggleClass('hidden');
    });

    $('.btn-next-preview-edit').click(function () {
        var checkDataStepAnswer = checkStepAnswer();
        console.log('list type: ' + JSON.stringify(list_type_questions));
        console.log('list answer: ' + JSON.stringify(listAnswer));
        console.log('list keyword: ' + JSON.stringify(listKeyword));
        if (checkDataStepAnswer) {
            $('.preview-edit-lesson').toggleClass('hidden');
            $('.edit-answer').toggleClass('hidden');
            $('#pr-quiz').html(content_quiz);
            $('#pr-quiz .last-option').each(function () {
                var qnumber = $(this).data('qnumber');
                var qorder = $(this).attr('name');
                qorder = qorder.match(/\d+/);
                var answer_key = $('.answer-' + qorder).val();
                $(this).parent().after( '<div class="explain-area explain-' + qorder + ' explain-area-' + qnumber + '" data-qnumber="' + qnumber + '" data-qorder="' + qorder + '" data-type-question="' + list_type_questions[qnumber] + '">' +
                    '<div class="show-answer">' +
                    '<button type="button" class="btn btn-danger btn-show-answer">Answer ' + qorder + ' ' +
                    '<div class="badge badge-pill key-answer">' +
                    answer_key +
                    '</div>' +
                    '</button>' +
                    '<div class="keywords-show ' + listClassKeyword[qnumber] + '" id="keywordArea-' + qnumber +'"> ' +
                    '<span class="keywords-area-title">' +
                    '<i class="fa fa-key" aria-hidden="true"></i>' +
                    '&nbsp;Keywords' +
                    '</span>' +
                    '<span class="keywords-area">' +
                    listKeyword_source[qnumber] +
                    '</span>' +
                    '</div>' +
                    '</div>' +
                    '<div class="solution-tools locate-highlight-tool">' +
                    '<a class="btn btn-xs btn-outline-warning btn-locate-highlight" data-qnumber="' + qnumber +'" onclick="scrollToHighlight(' + qorder + ')">' +
                    '<i class="fa fa-map-marker" aria-hidden="true"></i>' +
                    '&nbsp;Locate' +
                    '</a>' +
                    '</div>' +
                    // '<div class="solution-tools locate-keyword-tool">' +
                    //     '<a class="btn btn-xs btn-outline-info btn-show-keywords" data-qnumber="' + qnumber +'" data-toggle="collapse" href="#keywordArea-' + qnumber + '" aria-expanded="false" aria-controls="keywordArea-' + qnumber + '" onclick="showKeywords(' + qnumber + ')">' +
                    //         '<i class="fa fa-key" aria-hidden="true"></i>' +
                    //         '&nbsp;Keywords' +
                    //     '</a>' +
                    // '</div>' +
                    '<div class="solution-tools locate-comment-tool">' +
                    '<a class="btn btn-xs btn-outline-primary btn-show-comments" data-qnumber="' + qnumber +'" data-toggle="collapse" href="#commentArea-' + qnumber + '" aria-expanded="false" aria-controls="commentArea-' + qnumber + '" onclick="showComments(' + qnumber + ')">' +
                    '<i class="fa fa-question" aria-hidden="true"></i>' +
                    '&nbsp;Comments' +
                    '</a>' +
                    '</div>' +
                    // '<div class="collapse collage-keywords collapse-custom" id="keywordArea-' + qnumber +'"> ' +
                    //     '<div class="card card-header keywords-area-title">KEYWORDS:' +
                    //     '</div>' +
                    //     '<div class="card card-block keywords-area">' +
                    //     '</div>' +
                    // '</div>' +
                    '<div class="collapse collage-comments collapse-custom" id="commentArea-' + qnumber +'"> ' +
                    '<div class="card card-header comments-area-title">QUESTION & ANSWER:' +
                    '</div>' +
                    '<div class="card card-block comments-area">' +
                    '</div>' +
                    '</div>' +
                    '</div>');
            });
            $('#pr-quiz input').each(function () {
                $(this).attr('disabled', 'disabled');
            });
            $('#pr-quiz select').each(function () {
                $(this).attr('disabled', 'disabled');
            });
            content_answer_quiz =  $('#pr-quiz').html();
        }
        else {
            bootbox.alert({
                message: "Please enter answer of quiz!",
                backdrop: true
            });
        }
    });

    $('.btn-back-edit-answer').click(function () {
        $('.preview-edit-lesson').toggleClass('hidden');
        $('.edit-answer').toggleClass('hidden');
    });

    $('.btn-update-quiz-lesson').click(function () {
        var limit_time = $('#limitTime').val();
        console.log('list list_type_old: ' + JSON.stringify(list_type_old));
        console.log('list list_Q_old: ' + JSON.stringify(list_Q_old));
        console.log('list keyword: ' + JSON.stringify(listKeyword));
        console.log('list lesson_id: ' + lesson_id);
        console.log('list list_answer: ' + JSON.stringify(listAnswer));
        console.log('list type_lesson: ' + type_lesson);
        console.log('list limit_time: ' + limit_time);
        $.ajax({
            type: "POST",
            url: ajaxUpdateQuizReadingReading,
            dataType: "json",
            data: { lesson_id: lesson_id, list_type_old: list_type_old, list_Q_old: list_Q_old, list_answer: listAnswer, content_quiz: content_quiz, content_answer_quiz: content_answer_quiz, list_type_questions: list_type_questions, listKeyword: listKeyword, type_lesson: type_lesson, limit_time: limit_time },
            success: function (data) {
                console.log(data);
                bootbox.alert({
                    message: "Update quiz success! " + data.result,
                    backdrop: true,
                    callback: function(){
                        location.href= baseUrl + '/editLessonReading/' + data.result;
                    }
                });
            },
            error: function (data) {
                bootbox.alert({
                    message: "Update quiz fail!",
                    backdrop: true
                });
            }
        });
    });

});

$(document).on("change", "input.answer-q",function() {
    var qnumber = $(this).data('qnumber');
    listAnswer_source[qnumber] = $(this).val();
});

$(document).on("change", "textarea.input-keyword",function() {
    var qnumber = $(this).data('qnumber');
    listKeyword_source[qnumber] = $(this).val();
    if (listKeyword_source[qnumber] == '') {
        listClassKeyword[qnumber] = 'hidden-class';
    }
    else {
        listClassKeyword[qnumber] = '';
    }
});

$(document).on("change", ".enter-type-question select",function() {
    var qnumber = $(this).data('qnumber');
    list_type_questions_source[qnumber] = $(this).val();
});

function checkStepQuiz() {
    if (CKEDITOR.instances["quizLesson"].getData() == '') {
        bootbox.alert({
            message: "Please enter the content of quiz!",
            backdrop: true
        });
        return false;
    }
    else return true;
}

function checkStepAnswer() {
    listAnswer = {};
    listKeyword = {};
    list_type_questions = {};

    $('.preview-content-quiz .card-block .last-option').each(function () {
        var qnumber = $(this).data('qnumber');
        var qorder = $(this).attr('name');
        qorder = qorder.match(/\d+/);
        var answer_key = $('.answer-' + qorder).val().trim();
        var keywords_key = $('.keyword-' + qorder).val();
        if (answer_key != '') {
            listAnswer[qnumber] = answer_key;
        }
        else {
            delete listAnswer[qnumber];
        }
        if (keywords_key == '') {
            keywords_key = 'No_keywords';
            listClassKeyword[qnumber] = 'hidden-class';
        }
        else {
            listClassKeyword[qnumber] = '';
        }
        listKeyword[qnumber] = keywords_key;

        if (type_lesson == 1) {
            var type_question_key = $('#onlyTypeQuestion').val();
        }
        else {
            var type_question_key = $('.sl-type-question-' + qorder).val();
        }

        if (type_question_key != '') {
            list_type_questions[qnumber] = type_question_key;
        }
        else {
            delete list_type_questions[qnumber];
        }
    });
    if ((listQ.length == Object.keys(listAnswer).length) && (listQ.length  == Object.keys(list_type_questions).length)) {
        return true;
    }
    else return false;
}
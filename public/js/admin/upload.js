/**
 * Created by BiPham on 7/9/2017.
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('[name="_token"]').val()
    }
});
var content_post = '';
var content_highlight = '';
var content_quiz = '';
var content_answer_quiz = '';
var limit_time = 0;
var cate_selected = '';
var type_question = '';
var option_list_questions = '';
var type_lesson = 1;
var title_post = '';
var img_url = '';
var img_name = '';
var img_name_no_ext = '';
var img_extension = '';
var listQ = [];
var listAnswer = {};
var listKeyword = {};
var listClassKeyword = {};
var list_type_questions = {};
var listAnswer_source = {};
var listKeyword_source = {};
var list_type_questions_source = {};
var i = '';
var idremove = '';
var listHl = [];
var noti = false;
var sandbox = document.getElementById('sandbox');
var boolRemove = false;
var baseUrl = document.location.origin;
var mainUrl = baseUrl.substring(13);
var ajaxCreateNewCate = baseUrl + '/createNewCate';
var ajaxCreateNewTypeQuiz = baseUrl + '/createNewTypeQuiz';
var ajaxGetListTypeQuestion = baseUrl + '/getTypeQuestion';
var ajaxUploadFinish = baseUrl + '/uploadReadingLesson';
var hltr = new TextHighlighter(sandbox, {
    onBeforeHighlight: function (range) {
        i = prompt("Higlight for answer number:", "");
        console.log('i: ' + i);
        if (i) {
            hltr.options['highlightedClass'] ='answer-highlight highlight-' + i;
            if (jQuery.inArray(i, listHl) == -1) {
                listHl.push(i);
            }
            return true;
        }
        else return false;
    },
    onAfterHighlight: function (range, hlts) {
        var qnumber = $('.answer-' + i).data('qnumber');
        $('.highlight-' + i).attr('data-qnumber', qnumber);
        var idClass = 'hl-answer-' + qnumber;
        $('.highlight-' + i).attr('id', idClass);
        console.log('div: ' + $('.remove-ans-' + i).length);
        if ($('.remove-ans-' + i).length == 0) {
            $('.remove-highlight-area').append('<div class="remove-ans-' + i + '">Remove highlight for anwser ' + i + ': <button class="btn btn-info remove" data-removeid="' + i + '">Remove</button></div>');
        }
    },
    onRemoveHighlight: function (hl) {
        var clcus = 'answer-highlight highlight-' + idremove;
        if (hl.className == clcus) {
            if (!noti) {
                boolRemove = window.confirm('Do you really want to remove: "' + hl.className + '"');
                noti = true;
            }
            console.log('bnool: ' + boolRemove);
            if (boolRemove) {
                $('.remove-ans-' + idremove).remove();
                return true;
            }
        }
        else return false;
    }
});

$( document ).ready(function() {
    content_post = CKEDITOR.instances["contentPost"].getData();
    content_quiz = CKEDITOR.instances["contentQuiz"].getData();
    type_lesson = $('#typeLesson').val();
    $('.btn-next-step-quiz').click(function () {
        cate_selected = $('#prtcate').val();
        title_post = $('input#itemname').val();
        var checkDataStepPost = checkStepPost();
        if (checkDataStepPost) {
            $('.step-content-post').addClass('hidden-class');
            $('.step-content-quiz').removeClass('hidden-class');
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
        }
    });

    $('.btn-prev-step-post').click(function () {
        $('.step-content-quiz').addClass('hidden-class');
        $('.step-content-post').removeClass('hidden-class');
    });

    $('.btn-next-step-answer').click(function () {
        var checkDataStepQuiz = checkStepQuiz();
        console.log('type Lesson: ' + type_lesson);
        if (checkDataStepQuiz) {
            if ((content_quiz != CKEDITOR.instances["contentQuiz"].getData()) || (type_lesson != $('#typeLesson').val()) ) {
                content_quiz = CKEDITOR.instances["contentQuiz"].getData();
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
                $('.question-quiz').each(function () {
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
                $('.step-content-quiz').addClass('hidden-class');
                $('.step-answer-key').removeClass('hidden-class');
            }
            else {
                bootbox.alert({
                    message: "Please enter question of quiz!",
                    backdrop: true
                });
            }
        }
    });

    $('.btn-prev-step-quiz').click(function () {
        $('.step-content-quiz').removeClass('hidden-class');
        $('.step-answer-key').addClass('hidden-class');
    });

    $('.btn-next-step-highlight').click(function () {
        var checkDataStepAnswer = checkStepAnswer();
        console.log('list type: ' + JSON.stringify(list_type_questions));
        console.log('list answer: ' + JSON.stringify(listAnswer));
        console.log('list keyword: ' + JSON.stringify(listKeyword));
        if (checkDataStepAnswer) {
            $('.step-highlight-answer').removeClass('hidden-class');
            $('.step-answer-key').addClass('hidden-class');
            if (content_post != CKEDITOR.instances["contentPost"].getData()) {
                content_post = CKEDITOR.instances["contentPost"].getData();
                $('.remove-highlight-area').html('');
                $('#sandbox').html(content_post);
            }
        }
        else {
            bootbox.alert({
                message: "Please enter answer of quiz!",
                backdrop: true
            });
        }
    });

    $('.btn-prev-step-answer').click(function () {
        $('.step-answer-key').removeClass('hidden-class');
        $('.step-highlight-answer').addClass('hidden-class');
    });

    $('.btn-next-step-preview').click(function () {
        content_highlight = $('#sandbox').html();
        $('.step-preview-post').removeClass('hidden-class');
        $('.step-highlight-answer').addClass('hidden-class');
        $('#pr-post').html(content_highlight);
        $('.answer-highlight').addClass('hidden-highlight');
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
                                                    listKeyword[qnumber] +
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
        content_highlight = $('#pr-post').html();
    });

    $('.btn-prev-step-highlight').click(function () {
        $('.step-preview-post').addClass('hidden-class');
        $('.step-highlight-answer').removeClass('hidden-class');
        $('.answer-highlight').removeClass('hidden-highlight');
        $('.answer-highlight').removeClass('highlighting');
        $('#pr-post').html('');
        $('#pr-quiz').html('');
    });

    $('.btn-create-new-cate').click(function () {
        var cateName = $('input#newCate').val();
        if (cateName == '') {
            bootbox.alert({
                message: "Name of cate not null!",
                backdrop: true
            });
        }
        else {
            $.ajax({
                type: "GET",
                url: ajaxCreateNewCate,
                dataType: "json",
                data: { cateName: cateName },
                success: function (data) {
                    $('#prtcate').append('<option selected value="' + data.cate_id + '">' + data.newCate + '</option>');
                    $('#newCate').val('');
                    bootbox.alert({
                        message: "Create cate success!",
                        backdrop: true
                    });
                },
                error: function (data) {
                    bootbox.alert({
                        message: "Create cate fail!",
                        backdrop: true
                    });
                }
            });
        }
    });

    // $('.btn-create-new-type-quiz').click(function () {
    //     var typeName = $('input#newTypeQuiz').val();
    //     $.ajax({
    //         type: "GET",
    //         url: ajaxCreateNewTypeQuiz,
    //         dataType: "json",
    //         data: { typeName: typeName },
    //         success: function (data) {
    //             $('#show-list-type-quiz').append('<input type="checkbox" name="type_quiz" value="' + data.typeId + '">' + data.typeName + '<br />');
    //             $('#newTypeQuiz').val('');
    //             bootbox.alert({
    //                 message: "Create cate success!",
    //                 backdrop: true
    //             });
    //         },
    //         error: function (data) {
    //             bootbox.alert({
    //                 message: "Create cate fail!",
    //                 backdrop: true
    //             });
    //         }
    //     });
    // });

    $('.btn-finish-steps').click(function () {
        $('#loading').show();
        limit_time = $('#limitTime').val();
        // type_question = getValueTypeQuestion();
        $.ajax({
            type: "POST",
            url: ajaxUploadFinish,
            dataType: "json",
            data: { img_url: img_url, img_name: img_name, img_name_no_ext: img_name_no_ext, img_extension: img_extension, title_post: title_post, list_answer: listAnswer, cate_selected: cate_selected, content_post: content_post, content_highlight: content_highlight, content_quiz: content_quiz, content_answer_quiz: content_answer_quiz, list_type_questions: list_type_questions, listKeyword: listKeyword, type_lesson: type_lesson, limit_time: limit_time },
            success: function (data) {
                $('#loading').hide();
                bootbox.alert({
                    message: "Create post success!",
                    backdrop: true,
                    callback: function(){
                        location.href= 'http://' + mainUrl + '/reading';
                    }
                });
            },
            error: function (data) {
                $('#loading').hide();
                bootbox.alert({
                    message: "Create post fail!",
                    backdrop: true
                });
            }
        });
    });
});

$(document).on("click", ".remove",function() {
    idremove = $(this).data('removeid');
    noti = false;
    hltr.removeHighlights();
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

function readURL(input) {
    img_name = $('input[type=file]').val().split('\\').pop();
    img_extension = img_name.substr( (img_name.lastIndexOf('.') + 1) ).toLowerCase();
    img_name_no_ext = img_name.split('.')[0];
    var allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
    if( allowedExtensions.indexOf(img_extension) == -1 ) {
        bootbox.alert({
            message: "Img not true format!",
            backdrop: true
        });
        $('#imgFeature').val('');
        img_name = '';
        img_name_no_ext = '';
        $("#image-main-preview").attr('src', '#');
        $("#image-main-preview").addClass('hidden-class');
        i++;
        return;
    }
    else {
        img_name = $('input[type=file]').val().split('\\').pop();
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("#" + input.name + "-preview")
                    .attr('src', e.target.result)
                    .width(150);
                img_url = e.target.result;
                $("#" + input.name + "-preview").removeClass('hidden-class');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
}

function checkStepPost() {
    if (cate_selected == '') {
        bootbox.alert({
            message: "Please select category first!",
            backdrop: true
        });
        return false;
    }
    else if (title_post == '') {
        bootbox.alert({
            message: "Please enter name the post!",
            backdrop: true
        });
        return false;
    }
    else if (img_name == '') {
        bootbox.alert({
            message: "Please select image feature!",
            backdrop: true
        });
        return false;
    }
    else if (CKEDITOR.instances["contentPost"].getData() == '') {
        bootbox.alert({
            message: "Please enter the content of post!",
            backdrop: true
        });
        return false;
    }
    else return true;
}

function checkStepQuiz() {
    if (CKEDITOR.instances["contentQuiz"].getData() == '') {
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
        var type_question_key = '';

        if (type_lesson == 1) {
            type_question_key = $('#onlyTypeQuestion').val();
        }
        else {
            type_question_key = $('.sl-type-question-' + qorder).val();
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

// function getValueTypeQuestion() {
//     var list_type_question = [];
//     $('.type-quiz .card-block #show-list-type-quiz input[name=type_quiz]:checked').each(function () {
//         var val_type = $(this).val();
//         list_type_question.push(val_type);
//     });
//     return list_type_question;
// }
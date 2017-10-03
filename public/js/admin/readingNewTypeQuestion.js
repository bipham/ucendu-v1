$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('[name="_token"]').val()
    }
});

var baseUrl = document.location.origin;
var mainUrl = baseUrl.substring(13);
var ajaxFinishCreateNewTypeQuestion = baseUrl + '/createNewTypeQuestion';
var ajaxFinishCreateNewSectionOfTypeQuestion = baseUrl + '/createNewSectionTypeQuestion';
var view_layout = '';
var content_section = '';
var left_section = '';
var right_section = '';
var listQ = [];
var listAnswer = {};
var listKeyword = {};
var listClassKeyword = {};
var list_type_questions = {};
var listAnswer_source = {};
var listKeyword_source = {};
var list_type_questions_source = {};
var i = '';
var ajaxGetListTypeQuestion = baseUrl + '/getTypeQuestion';
var ajaxGetStepSection = baseUrl + '/getStepSection';
var option_list_questions = '';
$( document ).ready(function() {
    content_section = CKEDITOR.instances["content_section"].getData();
    left_section = CKEDITOR.instances["left_section"].getData();
    right_section = CKEDITOR.instances["right_section"].getData();

    $('#view_layout').on('change', function () {
        view_layout = $(this).val().trim();
        if (view_layout == 2) {
            $('.two-layout-content').removeClass('hidden');
        }
        else {
            $('.two-layout-content').addClass('hidden');
        }
    });

    $('.btn-finish-new-type-question').click(function () {
        var name_type_question = $('#type_question_name').val().trim();
        if (name_type_question == '') {
            bootbox.alert({
                message: "Please enter data!",
                backdrop: true
            });
        }
        else {
            $.ajax({
                type: "POST",
                url: ajaxFinishCreateNewTypeQuestion,
                dataType: "json",
                data: { name_type_question: name_type_question },
                success: function (data) {
                    bootbox.alert({
                        message: "Create new type question success!",
                        backdrop: true,
                        callback: function(){
                            $('#list_type_questions').append('<option selected value="' + data.new_type_question_id + '">' + name_type_question + '</option>');
                            $('#type_question_name').val('');
                            $('#readingCreateNewTypeQuestion').modal('toggle');
                        }
                    });
                },
                error: function (data) {
                    bootbox.alert({
                        message: "FAIL CREATE NEW TYPE QUESTIONS!",
                        backdrop: true
                    });
                }
            });
        }
    });

    $('.btn-create-new-section-type-question').click(function () {
        var type_question_id = $('#list_type_questions').val().trim();
        var title_section = $('#title_section').val().trim();
        var level_id = $('#list_level').val().trim();
        var step_section = $('#step_section').val().trim();
        var view_layout = $('#view_layout').val().trim();
        var name_icon_section = $('#name_icon_section').val().trim();
        var content_section = CKEDITOR.instances["content_section"].getData().trim();
        var checkDataStepAnswer = checkStepAnswer();
        if (!checkDataStepAnswer || type_question_id == '' || title_section == '' || name_icon_section == '') {
            bootbox.alert({
                message: "Please enter data!",
                backdrop: true
            });
        }
        else {
            $.ajax({
                type: "POST",
                url: ajaxFinishCreateNewSectionOfTypeQuestion,
                dataType: "json",
                data: { type_question_id: type_question_id, level_id: level_id, step_section: step_section, view_layout: view_layout, title_section: title_section, name_icon_section: name_icon_section, content_section: content_section, left_section: left_section, right_section: right_section ,list_answer: listAnswer, list_type_questions: list_type_questions, listKeyword: listKeyword },
                success: function (data) {
                    bootbox.alert({
                        message: "Create new section of type question success!",
                        backdrop: true,
                        callback: function(){
                            location.href= baseUrl + '/createNewTypeQuestion';
                        }
                    });
                },
                error: function (data) {
                    bootbox.alert({
                        message: "FAIL CREATE NEW SECTION OF TYPE QUESTION!",
                        backdrop: true
                    });
                }
            });
        }
    });

    $('.btn-next-step-second').click(function () {
        // check quiz:
        $.ajax({
            type: "GET",
            url: ajaxGetListTypeQuestion,
            dataType: "json",
            success: function (data) {
                option_list_questions = '';
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

        //get Step:
        var type_question_id = $('#list_type_questions').val().trim();
        var step_section = $('#step_section').val().trim();

        $.ajax({
            type: "GET",
            url: ajaxGetStepSection,
            dataType: "json",
            data: { type_question_id: type_question_id,  step_section: step_section},
            success: function (data) {
                console.log(data.step_section.step_section);
                var new_step = data.step_section.step_section + 1;
                $('#step_section').attr({
                    'min': new_step,
                    'value': new_step
                });
            },
            error: function (data) {
                bootbox.alert({
                    message: "FAIL get step section!",
                    backdrop: true
                });
            }
        });

        $('.step-first').addClass('hidden');
        $('.step-second').removeClass('hidden');
        $("html, body").animate({
            scrollTop: $('.new-learning-container').offset().top
        }, 100);
    });

    $('.btn-prev-step-first').click(function () {
        $('.step-second').addClass('hidden');
        $('.step-first').removeClass('hidden');
        $("html, body").animate({
            scrollTop: $('.new-learning-container').offset().top
        }, 100);
    });

    $('.btn-next-step-third').click(function () {
        if ((content_section != CKEDITOR.instances["content_section"].getData()) || (left_section != CKEDITOR.instances["left_section"].getData()) || (right_section != CKEDITOR.instances["right_section"].getData()) ) {
            content_section = CKEDITOR.instances["content_section"].getData();
            left_section = CKEDITOR.instances["left_section"].getData();
            right_section = CKEDITOR.instances["right_section"].getData();
            var content_learning = content_section + left_section + right_section;
            $('.preview-content-quiz .card-block').html(content_learning);
            $('.answer-area').html('');
            listQ = [];
            $('.question-quiz').each(function () {
                var qnumber = $(this).data('qnumber');
                if (jQuery.inArray(qnumber, listQ) == -1) {
                    listQ.push(qnumber);
                    var qorder = $(this).attr('name');
                    qorder = qorder.match(/\d+/);
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
                if (jQuery.inArray(qnumber, listAnswer_source) == -1) {
                    $('input.answer-q[data-qnumber=' + qnumber + ']').val(listAnswer_source[qnumber]);
                    $('textarea.input-keyword[data-qnumber=' + qnumber + ']').val(listKeyword_source[qnumber]);
                    $('.enter-type-question select[data-qnumber=' + qnumber + ']').val(list_type_questions_source[qnumber]);
                }
            });
        }
        console.log('listQ: ' + listQ);
        if (listQ.length > 0) {
            $('.no-question').addClass('hidden-class');
        }
        else {
            $('.no-question').removeClass('hidden-class');
        }
        $('.step-second').addClass('hidden');
        $('.step-third').removeClass('hidden');
        $("html, body").animate({
            scrollTop: $('.new-learning-container').offset().top
        }, 100);
    });

    $('.btn-prev-step-second').click(function () {
        $('.step-third').addClass('hidden');
        $('.step-second').removeClass('hidden');
        $("html, body").animate({
            scrollTop: $('.new-learning-container').offset().top
        }, 100);
    });
});

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
        var type_question_key = $('.sl-type-question-' + qorder).val();

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
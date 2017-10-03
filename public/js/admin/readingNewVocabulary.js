/**
 * Created by BiPham on 9/1/2017.
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('[name="_token"]').val()
    }
});

var baseUrl = document.location.origin;
var mainUrl = baseUrl.substring(13);
var ajaxFinishCreateNewVocabulary = baseUrl + '/createNewVocabulary';
var ajaxFinishCreatePhraseWord = baseUrl + '/createNewPhraseWord';

$('.btn-finish-new-type-voca').click(function () {
    var name_vocabulary = $('#name_vocabulary').val().trim();
    var name_icon_vocabulary = $('#name_icon_vocabulary').val().trim();
    if (name_vocabulary == '') {
        bootbox.alert({
            message: "Please enter data!",
            backdrop: true
        });
    }
    else {
        $.ajax({
            type: "POST",
            url: ajaxFinishCreateNewVocabulary,
            dataType: "json",
            data: { name_vocabulary: name_vocabulary, name_icon_vocabulary: name_icon_vocabulary },
            success: function (data) {
                bootbox.alert({
                    message: "Create new type vocabulary success!",
                    backdrop: true,
                    callback: function(){
                        $('#list_vocabularies').append('<option selected value="' + data.new_vocabulary_id + '">' + name_vocabulary + '</option>');
                        $('#name_vocabulary').val('');
                        $('#name_icon_vocabulary').val('');
                        $('#readingCreateNewVocabulary').modal('toggle');
                    }
                });
            },
            error: function (data) {
                bootbox.alert({
                    message: "FAIL CREATE NEW VOCABULARY!",
                    backdrop: true
                });
            }
        });
    }
});


$('.btn-create-new-phrase-word').click(function () {
    var name_phrase_word = $('#name_phrase_word').val().trim();
    var vocabulary_id = $('#list_vocabularies').val().trim();
    var content_phrase_vocabulary = CKEDITOR.instances["content_phrase_vocabulary"].getData().trim();
    if (content_phrase_vocabulary == '' || name_phrase_word == '' || vocabulary_id == '') {
        bootbox.alert({
            message: "Please enter data!",
            backdrop: true
        });
    }
    else {
        $.ajax({
            type: "POST",
            url: ajaxFinishCreatePhraseWord,
            dataType: "json",
            data: { vocabulary_id: vocabulary_id, name_phrase_word: name_phrase_word, content_phrase_vocabulary: content_phrase_vocabulary },
            success: function (data) {
                bootbox.alert({
                    message: "Create new phrase word success!",
                    backdrop: true,
                    callback: function(){
                        location.href= baseUrl + '/createNewVocabulary';
                    }
                });
            },
            error: function (data) {
                bootbox.alert({
                    message: "FAIL CREATE NEW PHRASE WORD!",
                    backdrop: true
                });
            }
        });
    }
});
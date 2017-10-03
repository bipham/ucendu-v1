/**
 * Created by BiPham on 9/7/2017.
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('[name="_token"]').val()
    }
});

var img_url_author = '';
var img_url_cover = '';
var img_name_cover = '';
var img_name_cover_no_ext = '';
var img_name_cover_extension = '';
var img_name_author = '';
var img_name_author_no_ext = '';
var img_name_author_extension = '';
var baseUrl = document.location.origin;
var mainUrl = baseUrl.substring(13);
var ajaxFinishCreateNewStory = baseUrl + '/createNewStory';
var ajaxFinishCreateNewChapterOfStory = baseUrl + '/createNewChapterOfStory';

$('.btn-finish-new-story').click(function () {
    var new_title_story = $('#new_title_story').val().trim();
    var name_author = $('#name_author').val().trim();
    var level_story = $('#level_story').val().trim();
    var genre_story = $('#genre_story').val().trim();
    var length_story = $('#length_story').val().trim();
    if (name_author == '' || new_title_story == '' || img_url_cover == '' || img_url_author == '' || level_story == '' || genre_story == '' || length_story == '') {
        bootbox.alert({
            message: "Please enter data!",
            backdrop: true
        });
    }
    else {
        $('#loading').show();
        $.ajax({
            type: "POST",
            url: ajaxFinishCreateNewStory,
            dataType: "json",
            data: { name_author: name_author, level_story: level_story, genre_story: genre_story, length_story: length_story, img_url_cover: img_url_cover, img_name_cover: img_name_cover, img_name_cover_no_ext: img_name_cover_no_ext, img_name_cover_extension: img_name_cover_extension, img_url_author: img_url_author, img_name_author: img_name_author, img_name_author_no_ext: img_name_author_no_ext, img_name_author_extension: img_name_author_extension, new_title_story: new_title_story },
            success: function (data) {
                $('#loading').hide();
                bootbox.alert({
                    message: "Create new type story success!",
                    backdrop: true,
                    callback: function(){
                        $('#list_stories').append('<option selected value="' + data.story_id + '">' + new_title_story + '</option>');
                        $('#new_title_story').val('');
                        $('#imgFeature').val('');
                        img_name = '';
                        $("#image-main-preview").attr('src', '#');
                        $("#image-main-preview").addClass('hidden-class');
                        $('#readingCreateNewStory').modal('toggle');
                    }
                });
            },
            error: function (data) {
                $('#loading').hide();
                bootbox.alert({
                    message: "FAIL CREATE NEW TYPE STORY!",
                    backdrop: true
                });
            }
        });
    }
});

$('.btn-create-new-chapter-of-story').click(function () {
    var title_chapter = $('#title_chapter').val().trim();
    var order_chapter = $('#order_chapter').val().trim();
    var number_images_chapter = $('#number_images_chapter').val().trim();
    var story_id = $('#list_stories').val().trim();
    var content_chapter = CKEDITOR.instances["content_chapter"].getData().trim();
    if (story_id == '' || title_chapter == '' || order_chapter == '' || number_images_chapter == '' || content_chapter == '') {
        bootbox.alert({
            message: "Please enter data!",
            backdrop: true
        });
    }
    else {
        $('#loading').show();
        $.ajax({
            type: "POST",
            url: ajaxFinishCreateNewChapterOfStory,
            dataType: "json",
            data: { story_id: story_id, title_chapter: title_chapter, order_chapter: order_chapter, number_images_chapter: number_images_chapter, content_chapter: content_chapter },
            success: function (data) {
                $('#loading').hide();
                if (data.result == 'success') {
                    bootbox.alert({
                        message: "Create new chapter of story success!",
                        backdrop: true,
                        callback: function(){
                            location.href= baseUrl + '/uploadReadingStory';
                        }
                    });
                }
                else {
                    bootbox.alert({
                        message: "Order Chapter Wrong!",
                        backdrop: true
                    });
                }
            },
            error: function (data) {
                $('#loading').hide();
                bootbox.alert({
                    message: "FAIL CREATE NEW CHAPTER OF STORY!",
                    backdrop: true
                });
            }
        });
    }
});

function readCoverStory(input) {
    img_name_cover = $('input#imgFeature-story[type=file]').val().split('\\').pop();
    img_name_cover_no_ext = img_name_cover.split('.')[0];
    img_name_cover_extension = img_name_cover.substr( (img_name_cover.lastIndexOf('.') + 1) ).toLowerCase();
    var allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
    if( allowedExtensions.indexOf(img_name_cover_extension) == -1 ) {
        bootbox.alert({
            message: "Img not true format!",
            backdrop: true
        });
        $('input#imgFeature-story[type=file]').val('');
        $("#image-main-preview-story").attr('src', '#');
        $("#image-main-preview-story").addClass('hidden-class');
        img_name_cover = '';
        img_name_cover_no_ext = '';
        // i++;
        return;
    }
    else {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#image-main-preview-story")
                    .attr('src', e.target.result)
                    .width(150);
                img_url_cover = e.target.result;
                $("#image-main-preview-story").removeClass('hidden-class');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
}

function readAuthorAvatar(input) {
    img_name_author = $('input#imgFeature-author[type=file]').val().split('\\').pop();
    img_name_author_no_ext = img_name_author.split('.')[0];
    img_name_author_extension = img_name_author.substr( (img_name_author.lastIndexOf('.') + 1) ).toLowerCase();
    var allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
    if( allowedExtensions.indexOf(img_name_author_extension) == -1 ) {
        bootbox.alert({
            message: "Img not true format!",
            backdrop: true
        });
        $('input#imgFeature-author[type=file]').val('');
        $("#image-main-preview-author").attr('src', '#');
        $("#image-main-preview-author").addClass('hidden-class');
        img_name_author = '';
        img_name_author_no_ext = '';
        // i++;
        return;
    }
    else {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#image-main-preview-author")
                    .attr('src', e.target.result)
                    .width(150);
                img_url_author = e.target.result;
                $("#image-main-preview-author").removeClass('hidden-class');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
}
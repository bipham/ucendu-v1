/**
 * Created by BiPham on 7/19/2017.
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('[name="_token"]').val()
    }
});
var token = $('[name="_token"]').val();
var baseUrl = document.location.origin;
var isCreateReplyComment = false;
var isExpanded = [];
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};
var question_id_noti = getUrlParameter('question');
var comment_id_noti = getUrlParameter('comment');

console.log('question_id_noti ' + baseUrl);
console.log('comment_id_noti ' + comment_id_noti);

var mainUrl_tmp = baseUrl.substring(7);
var adminBaseUrl = 'http://admin.' + mainUrl_tmp;
function deleteReadingComment(id) {
    bootbox.confirm({
        title: "Delete Reading Comment",
        message: "Do you want to delete this comment?" + id,
        buttons: {
            cancel: {
                label: '<i class="fa fa-times"></i> Cancel',
                className: 'btn-danger'
            },
            confirm: {
                label: '<i class="fa fa-check"></i> Confirm',
                className: 'btn-success'
            }
        },
        callback: function (result) {
            if(result) {
                var ajaxDelCommentReading = baseUrl + '/deleteCommentReading/' + id;
                console.log('ajaxDelCommentReading ' + ajaxDelCommentReading);
                $.ajax({
                    type: "GET",
                    url: ajaxDelCommentReading,
                    dataType: "json",
                    // data: { },
                    success: function (data) {
                        bootbox.alert({
                            message: "Delete comment success! " + data.result,
                            backdrop: true,
                            callback: function(){
                                // location.href= baseUrl + '/listCommentReading';
                                var reply_id_deleted = $('.btn-set-comment-public[data-id=' + id + ']').data('reply-id');
                                if (reply_id_deleted == 0) {
                                    $('.list-cmt-' + id).remove();
                                }
                                else {
                                    $('#comment' + id).remove();
                                }
                            }
                        });
                    },
                    error: function (data) {
                        bootbox.alert({
                            message: "Delete comment fail!",
                            backdrop: true
                        });
                    }
                });
            }
        }
    });
}

function setPublicReadingComment(id) {
    var $this = $(this);
    bootbox.confirm({
        title: "Set public reading comment",
        message: "Do you want to set public for this comment?",
        buttons: {
            cancel: {
                label: '<i class="fa fa-times"></i> Cancel',
                className: 'btn-danger'
            },
            confirm: {
                label: '<i class="fa fa-check"></i> Confirm',
                className: 'btn-success'
            }
        },
        callback: function (result) {
            if(result) {
                var ajaxSetPublicReadingComment = baseUrl + '/setPublicReadingComment/' + id;
                $.ajax({
                    type: "GET",
                    url: ajaxSetPublicReadingComment,
                    dataType: "json",
                    // data: { },
                    success: function (data) {
                        bootbox.alert({
                            message: "Set public comment success! " + data.result,
                            backdrop: true,
                            callback: function(){
                                // location.href= baseUrl + '/listCommentReading';
                                $('.btn-set-comment-public[data-id=' + id + ']').prop('disabled', true);
                                $('.btn-set-comment-private[data-id=' + id + ']').prop('disabled', false);
                            }
                        });
                    },
                    error: function (data) {
                        bootbox.alert({
                            message: "Set public comment fail!",
                            backdrop: true
                        });
                    }
                });
            }
        }
    });
}

function setPrivateReadingComment(id) {
    bootbox.confirm({
        title: "Set private reading comment",
        message: "Do you want to set private for this comment?",
        buttons: {
            cancel: {
                label: '<i class="fa fa-times"></i> Cancel',
                className: 'btn-danger'
            },
            confirm: {
                label: '<i class="fa fa-check"></i> Confirm',
                className: 'btn-success'
            }
        },
        callback: function (result) {
            if(result) {
                var ajaxSetPrivateReadingComment = baseUrl + '/setPrivateReadingComment/' + id;
                $.ajax({
                    type: "GET",
                    url: ajaxSetPrivateReadingComment,
                    dataType: "json",
                    // data: { },
                    success: function (data) {
                        bootbox.alert({
                            message: "Set private comment success! " + data.result,
                            backdrop: true,
                            callback: function(){
                                // location.href= baseUrl + '/listCommentReading';
                                $('.btn-set-comment-public[data-id=' + id + ']').prop('disabled', false);
                                $('.btn-set-comment-private[data-id=' + id + ']').prop('disabled', true);
                            }
                        });
                    },
                    error: function (data) {
                        bootbox.alert({
                            message: "Set private comment fail!",
                            backdrop: true
                        });
                    }
                });
            }
        }
    });
}

function scrollToHighlight(i) {
    // alert('Scroll to: ' + i);
    var last_highlight = $('.highlighting');
    last_highlight.removeClass('highlighting');
    last_highlight.addClass('hidden-highlight');
    $('.highlight-' + i).removeClass('hidden-highlight');
    $('.highlight-' + i).addClass('highlighting');
    $("html, body").animate({
        scrollTop: $('.panel-container').offset().top
    }, 100);
    var qnumber = $('#lesson-highlight-area .highlight-' + i).data('qnumber');
    var idClass = 'highlight-' + i;
    var t = 60;
    var r = $(".left-panel-custom").offset().top;
    var u = $("."+idClass).offset().top;
    var f = $(".left-panel-custom").scrollTop();
    var v = u + f - r;
        $(".left-panel-custom").animate({
        scrollTop: v - t
    }, {
        duration: 100,
        complete: function () {
        }
    });
}

function scrollToExplain(q_index) {
    $("html, body").animate({
        scrollTop: $('.panel-container').offset().top
    }, 100);
    var t_question = 100;
    var r_question = $(".right-panel-custom").offset().top;
    var u_question = $(".explain-" + q_index).offset().top;
    var f_question = $(".right-panel-custom").scrollTop();
    var v_question = u_question + f_question - r_question;
    $(".right-panel-custom").animate({
        scrollTop: v_question - t_question
    }, {
        duration: 100,
        complete: function () {
        }
    });
}

$('.btn-show-answered').click(function () {
    var q_index = $(this).data('qorder');
    scrollToExplain(q_index);
});

function showComments(i, isTrigger) {
    isTrigger = isTrigger || false;
    var ajaxUrlShowComments = baseUrl + '/showComments/' + i;
    $('#loading').show();
    $.ajax({
        type: "GET",
        url: ajaxUrlShowComments,
        dataType: "json",
        // data: { list_answer: list_answer, quizId: quizId},
        success: function (data) {
            console.log('sucess:', data);
            $('#commentArea-' + i + ' .comments-area').html('');
            if (data.list_comments.length > 0) {
                jQuery.each( data.list_comments, function( index, list_comment ) {
                    var avatar = list_comment.avatar;
                    var cmt_content = list_comment.content_cmt;
                    var time_ago = list_comment.updated_at;
                    var cmt_id = list_comment.id;
                    var question_id = list_comment.question_id;
                    var username = list_comment.username;
                    var reply_id = list_comment.reply_id;
                    var isPrivated = '';
                    var isPublic = '';
                    var status_class = 'item-cmt-public';
                    if (list_comment.private == 1) {
                        isPrivated = 'disabled';
                        status_class = 'item-cmt-private';
                    }
                    else {
                        isPublic = 'disabled';
                    }

                    if (data.level_current_user == 0) {
                        if (reply_id == 0) {
                            $('#commentArea-' + i + ' .comments-area').append('<div class="row list-cmt-area list-cmt-' + cmt_id + '" data-cmt-id="' + cmt_id + '">' +
                                '<div class="item-cmt cmt-' + cmt_id + ' ' + status_class + '" id="comment' + cmt_id + '" data-cmt-id="' + cmt_id + '">'
                                + '<span class="img-avatar">'
                                + '<img alt="" src="/storage/img/users/' + avatar + '" class="img-custom avatar-custom" />'
                                + '</span>'
                                + '<span class="item-cmt-content">'
                                + '<div class="item-cmt-header">'
                                +  username
                                + '</div>'
                                + '<div class="item-cmt-body">'
                                +  cmt_content
                                + '</div>'
                                + '<div class="item-time-cmt">'
                                + '<span class="img-time-cmt">'
                                + '<img alt="time-cmt" src="/public/imgs/original/time.png" class="img-time-cmt" />'
                                + '</span>'
                                + '<span class="time-ago-cmt">'
                                + time_ago
                                + '</span>'
                                + '<span class="reply-cmt pull-right">'
                                + '<button type="button" class="btn btn-success btn-admin-custom btn-set-comment-public" data-id="' + cmt_id + '" data-question-id="' + question_id + '" data-reply-id="' + reply_id + '" onclick="setPublicReadingComment(' + cmt_id + ')"' + isPublic + '>Set public</button>'
                                + '<button type="button" class="btn btn-warning btn-admin-custom btn-set-comment-private" data-id="' + cmt_id + '" data-question-id="' + question_id + '" data-reply-id="' + reply_id + '" onclick="setPrivateReadingComment(' + cmt_id + ')"' + isPrivated + '>Set private</button>'
                                + '<button type="button" class="btn btn-danger btn-admin-custom btn-del-lesson" data-id="' + cmt_id + '" data-question-id="' + question_id + '" data-reply-id="' + reply_id + '" onclick="deleteReadingComment(' + cmt_id + ')">Del</button>'
                                + '<button type="button" class="btn btn-reply-cmt btn-sm btn-outline-primary" onclick="replyComment(' + cmt_id + ', ' + i + ')">Reply</button>'
                                + '</span>'
                                + '</div>'
                                + '</span>'
                                + '</div>'
                                + '</div>');
                        }
                        else {
                            $('.list-cmt-' + reply_id).append('<div class="item-cmt item-sub-cmt cmt-' + cmt_id + ' ' + status_class + '" id="comment' + cmt_id + '" data-cmt-id="' + cmt_id + '">'
                                + '<span class="img-avatar">'
                                + '<img alt="" src="/storage/img/users/' + avatar + '" class="img-custom avatar-custom" />'
                                + '</span>'
                                + '<span class="item-cmt-content">'
                                + '<div class="item-cmt-header">'
                                +  username
                                + '</div>'
                                + '<div class="item-cmt-body">'
                                +  cmt_content
                                + '</div>'
                                + '<div class="item-time-cmt">'
                                + '<span class="img-time-cmt">'
                                + '<img alt="time-cmt" src="/public/imgs/original/time.png" class="img-time-cmt" />'
                                + '</span>'
                                + '<span class="time-ago-cmt">'
                                + time_ago
                                + '</span>'
                                + '<span class="reply-cmt pull-right">'
                                + '<button type="button" class="btn btn-success btn-admin-custom btn-set-comment-public" data-id="' + cmt_id + '" data-question-id="' + question_id + '" data-reply-id="' + reply_id + '" onclick="setPublicReadingComment(' + cmt_id + ')"' + isPublic + '>Set public</button>'
                                + '<button type="button" class="btn btn-warning btn-admin-custom btn-set-comment-private" data-id="' + cmt_id + '" data-question-id="' + question_id + '" data-reply-id="' + reply_id + '" onclick="setPrivateReadingComment(' + cmt_id + ')"' + isPrivated + '>Set private</button>'
                                + '<button type="button" class="btn btn-danger btn-admin-custom btn-del-lesson" data-id="' + cmt_id + '" data-question-id="' + question_id + '" data-reply-id="' + reply_id + '" onclick="deleteReadingComment(' + cmt_id + ')">Del</button>'
                                + '<button type="button" class="btn btn-sm btn-outline-primary" onclick="replyComment(' + cmt_id + ', ' + i + ')">Reply</button>'
                                + '</span>'
                                + '</div>'
                                + '</span>'
                                + '</div>');
                        }
                    }
                    else if ((list_comment.private == 0) || (list_comment.user_id == data.user_id)) {
                        if (reply_id == 0) {
                            $('#commentArea-' + i + ' .comments-area').append('<div class="row list-cmt-area list-cmt-' + cmt_id + '" data-cmt-id="' + cmt_id + '">' +
                                '<div class="item-cmt cmt-' + cmt_id + '" id="comment' + cmt_id + '" data-cmt-id="' + cmt_id + '">'
                                + '<span class="img-avatar">'
                                + '<img alt="" src="/storage/img/users/' + avatar + '" class="img-custom avatar-custom" />'
                                + '</span>'
                                + '<span class="item-cmt-content">'
                                + '<div class="item-cmt-header">'
                                +  username
                                + '</div>'
                                + '<div class="item-cmt-body">'
                                +  cmt_content
                                + '</div>'
                                + '<div class="item-time-cmt">'
                                + '<span class="img-time-cmt">'
                                + '<img alt="time-cmt" src="/public/imgs/original/time.png" class="img-time-cmt" />'
                                + '</span>'
                                + '<span class="time-ago-cmt">'
                                + time_ago
                                + '</span>'
                                + '<span class="reply-cmt pull-right">'
                                + '<button type="button" class="btn btn-sm btn-outline-primary" onclick="replyComment(' + cmt_id + ', ' + i + ')">Reply</button>'
                                + '</span>'
                                + '</div>'
                                + '</span>'
                                + '</div>'
                                + '</div>');
                        }
                        else {
                            $('.list-cmt-' + reply_id).append('<div class="item-cmt item-sub-cmt cmt-' + cmt_id + '" id="comment' + cmt_id + '" data-cmt-id="' + cmt_id + '">'
                                + '<span class="img-avatar">'
                                + '<img alt="" src="/storage/img/users/' + avatar + '" class="img-custom avatar-custom" />'
                                + '</span>'
                                + '<span class="item-cmt-content">'
                                + '<div class="item-cmt-header">'
                                +  username
                                + '</div>'
                                + '<div class="item-cmt-body">'
                                +  cmt_content
                                + '</div>'
                                + '<div class="item-time-cmt">'
                                + '<span class="img-time-cmt">'
                                + '<img alt="time-cmt" src="/public/imgs/original/time.png" class="img-time-cmt" />'
                                + '</span>'
                                + '<span class="time-ago-cmt">'
                                + time_ago
                                + '</span>'
                                + '<span class="reply-cmt pull-right">'
                                + '<button type="button" class="btn btn-sm btn-outline-primary" onclick="replyComment(' + cmt_id + ', ' + i + ')">Reply</button>'
                                + '</span>'
                                + '</div>'
                                + '</span>'
                                + '</div>');
                        }
                    }
                });
            }
            if (jQuery.inArray(i, isExpanded) == -1) {
                isExpanded.push(i);

                var avatar = current_user.avatar;
                var username = current_user.username;
                var link = 'enterNewComment';

                $('#commentArea-' + i).append('<div class="item-reply-cmt" id="replyComment">'
                    + '<span class="img-avatar">'
                    + '<img alt="" src="/storage/img/users/' + avatar + '" class="img-custom avatar-custom" />'
                    + '</span>'
                    + '<span class="item-cmt-content">'
                    + '<div class="item-cmt-header">'
                    +  username
                    + '</div>'
                    + '<div class="item-cmt-body">'
                    + '<input type="text" placeholder=" Write your comment ..." class="reply-cmt reply-cmt-' + i + '" data-reply-cmt-id="0" data-question-id = "' + i + '">'
                    + '</div>'
                    + '<div class="item-time-cmt">'
                    + '</div>'
                    + '</span>'
                    + '</div>'
                    + '</div>');
            }
            var numItems = $('#commentArea-' + i + ' .comments-area .list-cmt-area').length;
            if (numItems == 0) {
                $('#commentArea-' + i + ' .comments-area').append('<p class="no-cmt">Chua co comment nao cho cau hoi nay!</p>');
            }

            $('#loading').hide();

            //Show Comment:
            if (isTrigger) {
                if (question_id_noti && comment_id_noti) {
                    $('html, body').animate({
                        scrollTop: $('.solution-detail').offset().top
                    }, 1000);

                    var t = 60;
                    var r = $(".right-panel-custom").offset().top;
                    var u = $("#comment" + comment_id_noti).offset().top;
                    var f = $(".right-panel-custom").scrollTop();
                    var v = u + f - r;
                    $(".right-panel-custom").animate({
                        scrollTop: v - t
                    });
                    $("#comment" + comment_id_noti).addClass('current-cmt');
                    setTimeout(function(){
                        $("#comment" + comment_id_noti).addClass('time-out-current-cmt');
                    }, 3000);
                }
            }
            else {
                $('html, body').animate({
                    scrollTop: $('.solution-detail').offset().top
                }, 1000);
                var t = 60;
                var r = $(".right-panel-custom").offset().top;
                var u = $("#commentArea-" + i).offset().top;
                var f = $(".right-panel-custom").scrollTop();
                var v = u + f - r;
                $(".right-panel-custom").animate({
                    scrollTop: v - t
                });
            }
        },
        error: function (data) {
            $('#loading').hide();
            console.log('Error:', data);
            bootbox.alert({
                message: "Error, please contact admin!",
                backdrop: true
            });
        }
    });
}

function showKeywords(i) {
    var ajaxUrlShowKeywords = baseUrl + '/showKeywords/' + i;
    console.log('keywords: ' + i);
    $.ajax({
        type: "GET",
        url: ajaxUrlShowKeywords,
        dataType: "json",
        // data: { list_answer: list_answer, quizId: quizId},
        success: function (data) {
            console.log('sucess:', data);
            $('#keywordArea-' + i + ' .keywords-area').html(data);
        },
        error: function (data) {
            console.log('Error:', data);
            bootbox.alert({
                message: "Error, please contact admin!",
                backdrop: true
            });
        }
    });
}

function replyComment(cmt_id, question_id) {
    var avatar = current_user.avatar;
    var username = current_user.username;
    var reply_id = $('.cmt-' + cmt_id).parent().data('cmt-id');
    var parentCmt = $('.cmt-' + cmt_id).parent('.list-cmt-area');
    var item_reply_sub_cmt = parentCmt.find('.item-reply-sub-cmt');
    if (item_reply_sub_cmt.length > 0) {
        $('input.reply-sub-cmt-' + question_id).data('reply-cmt-id', reply_id);
    }
    else {
        parentCmt.append('<div class="item-reply-sub-cmt item-sub-cmt" id="replySubComment">'
            + '<span class="img-avatar">'
            + '<img alt="" src="/storage/img/users/' + avatar + '" class="img-custom avatar-custom" />'
            + '</span>'
            + '<span class="item-cmt-content">'
            + '<div class="item-cmt-header">'
            +  username
            + '</div>'
            + '<div class="item-cmt-body">'
            + '<input type="text" placeholder=" Write a reply ..." class="reply-cmt reply-sub-cmt reply-sub-cmt-' + reply_id + '" data-reply-cmt-id="' + reply_id + '" data-question-id = "' + question_id + '">'
            + '</div>'
            + '<div class="item-time-cmt">'
            + '</div>'
            + '</span>'
            + '</div>'
            + '</div>');
    }

    $('input.reply-sub-cmt-' + reply_id).focus();
    $("html, body").animate({
        scrollTop: $('.panel-container').offset().top
    }, 100);
    var t = 100,
        r = $(".right-panel-custom").offset().top,
        u = $("input.reply-sub-cmt-" + reply_id).offset().top,
        f = $(".right-panel-custom").scrollTop(),
        v = u + f - r;
    $(".right-panel-custom").animate({
        scrollTop: v - t
    }, {
        duration: 100,
        complete: function () {
        }
    });
}

function enterComment(e) {
    if (e.keyCode == 13) {
        var user_id = current_user.id;
        var content_cmt = $(this).val().trim();
        if (content_cmt != '') {
            $(this).val('');
            var question_id_custom = $(this).data('question-id');
            var reply_id = $(this).data('reply-cmt-id');
            var ajaxUrlEnterReplyComment = baseUrl + '/enterNewComment';
            console.log('reply: ' + reply_id + ' question: ' + question_id_custom + 'content: ' + content_cmt);
            var token = $("input[name='_token']").val();
            $.ajax({
                type: "POST",
                url: ajaxUrlEnterReplyComment,
                dataType: "json",
                data: { '_token':token, user_id: user_id, content_cmt: content_cmt, question_id_custom: question_id_custom, reply_id: reply_id},
                success: function (data) {
                    console.log('sucess:', data);
                    var avatar = current_user.avatar;
                    var time_ago = 'Just now';
                    var cmt_id = data.list_comment.id;
                    var username = current_user.username;
                    $('p.no-cmt').remove();
                    $('.item-reply-sub-cmt').remove();
                    if ((data.list_comment.private == 0) || (data.list_comment.user_id == user_id)) {
                        if (reply_id == 0) {
                            $('#commentArea-' + question_id_custom + ' .comments-area').append('<div class="row list-cmt-area list-cmt-' + cmt_id + '" data-cmt-id="' + cmt_id + '">' +
                                '<div class="item-cmt cmt-' + cmt_id + '" data-cmt-id="' + cmt_id + '">'
                                + '<span class="img-avatar">'
                                + '<img alt="" src="/storage/img/users/' + avatar + '" class="img-custom avatar-custom" />'
                                + '</span>'
                                + '<span class="item-cmt-content">'
                                + '<div class="item-cmt-header">'
                                + username
                                + '</div>'
                                + '<div class="item-cmt-body">'
                                + content_cmt
                                + '</div>'
                                + '<div class="item-time-cmt">'
                                + '<span class="img-time-cmt">'
                                + '<img alt="time-cmt" src="/public/imgs/original/time.png" class="img-time-cmt" />'
                                + '</span>'
                                + '<span class="time-ago-cmt">'
                                + time_ago
                                + '</span>'
                                + '<span class="reply-cmt pull-right">'
                                + '<button type="button" class="btn btn-sm btn-outline-primary" onclick="replyComment(' + cmt_id + ', ' + question_id_custom + ')">Reply</button>'
                                + '</span>'
                                + '</div>'
                                + '</span>'
                                + '</div>'
                                + '</div>');
                        }
                        else {
                            $('.list-cmt-' + reply_id).append('<div class="item-cmt item-sub-cmt cmt-' + cmt_id + '" data-cmt-id="' + cmt_id + '">'
                                + '<span class="img-avatar">'
                                + '<img alt="" src="/storage/img/users/' + avatar + '" class="img-custom avatar-custom" />'
                                + '</span>'
                                + '<span class="item-cmt-content">'
                                + '<div class="item-cmt-header">'
                                + username
                                + '</div>'
                                + '<div class="item-cmt-body">'
                                + content_cmt
                                + '</div>'
                                + '<div class="item-time-cmt">'
                                + '<span class="img-time-cmt">'
                                + '<img alt="time-cmt" src="/public/imgs/original/time.png" class="img-time-cmt" />'
                                + '</span>'
                                + '<span class="time-ago-cmt">'
                                + time_ago
                                + '</span>'
                                + '<span class="reply-cmt pull-right">'
                                + '<button type="button" class="btn btn-sm btn-outline-primary" onclick="replyComment(' + cmt_id + ', ' + question_id_custom + ')">Reply</button>'
                                + '</span>'
                                + '</div>'
                                + '</span>'
                                + '</div>');
                        }
                    }
                    $('input.reply-cmt-' + question_id_custom).data('reply-cmt-id', 0);
                    $('html,body').animate({
                        scrollTop: $(".cmt-" + cmt_id).offset().top - 20
                    }, 500);
                },
                error: function (data) {
                    console.log('Error:', data);
                    bootbox.alert({
                        message: "Error, please contact admin!",
                        backdrop: true
                    });
                }
            });
        }
    }
}

$(document).on("keypress","input.reply-cmt",enterComment);

$(document).ready(function() {
    jQuery(function(){
        // jQuery('.btn-show-comments[data-qnumber=' + question_id_noti + ']').trigger('click');
        if (question_id_noti && comment_id_noti) {
            showComments(question_id_noti, true);
            $('#commentArea-' + question_id_noti).collapse();
        }
    });
});
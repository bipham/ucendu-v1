var myId = $('#userNotiAction').data('user-id');
var baseUrl = document.location.origin;
var noti_container = '';
var noti_header = '';
var noti_area = '';
var noti_fixed_element = '';
var openNoti = false;
var openNotiFixed = false;
var isStart = false;

$("#toolbar-open").click(function() {
    $(this).toggleClass('transform-open-toolbar-active');
    $('.toolbar-content').toggleClass('transform-content-toolbar-active');
    $('.icon-toolbar-close').toggleClass('hidden');
    $('.icon-toolbar-open').toggleClass('hidden');
    $('.overlay').toggleClass('overlay-active');
});

$(".overlay").click(function() {
    $(this).toggleClass('overlay-active');
    $('.toolbar-content').toggleClass('transform-content-toolbar-active');
    $('.icon-toolbar-close').toggleClass('hidden');
    $('.icon-toolbar-open').toggleClass('hidden');
    $('.open-toolbar').toggleClass('transform-open-toolbar-active');
});

$(".panel-left").resizable({
    handleSelector: ".splitter",
    resizeHeight: true
});
$(".panel-top").resizable({
    handleSelector: ".splitter-horizontal",
    resizeWidth: false
});

jQuery("document").ready(function($){

    var nav = $('.menu-reading');

    $('#myTabReading a:not(.reading-test-quiz)').on('shown.bs.tab', function (e) {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 139) {
                nav.addClass("reading-header-fixed");
                $('.left-custom #notifications-container-menu').hide();
                $('.left-custom .noti-status').removeClass('white-font-class');
                openNoti = false;
            } else {
                nav.removeClass("reading-header-fixed");
                $('.action-user-center-fixed #notifications-container-menu').hide();
                $('.action-user-center-fixed .noti-status').removeClass('white-font-class');
                openNotiFixed = false;
            }
        });
    });
    $('#myTabReading a.reading-test-quiz').on('shown.bs.tab', function (e) {
        $(window).unbind('scroll');
        $('footer.navbar-fixed-bottom').addClass('hidden');
        $('body').addClass('overflow-hidden-class');
    });

    $('#myTabReading a.reading-solution-quiz').on('shown.bs.tab', function (e) {
        $('footer.navbar-fixed-bottom').addClass('hidden');
    });

    $('#myTabReading a:not(.reading-test-quiz)').click(function () {
        $('header#header').removeClass('hidden');
        $('.menu-reading').removeClass('reading-header-fixed');
        $('footer.navbar-fixed-bottom').removeClass('hidden');
        $('body').removeClass('overflow-hidden-class');
    });

    $('#myTabReading a.reading-test-quiz').click(function () {
        if (isStart) {
            $('header#header').addClass('hidden');
            $('.menu-reading').addClass('reading-header-fixed');
        }
        $('body').addClass('overflow-hidden-class');
        $('footer.navbar-fixed-bottom').addClass('hidden');
    });

    $('#myTabReading a.reading-solution-quiz').click(function () {
        $('footer.navbar-fixed-bottom').addClass('hidden');
    });

});

$(document).mouseup(function(e)
{
    var container = $('.left-custom .notification-status');
    var container_fixed = $('.action-user-center-fixed .notification-status');

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0)
    {
        openNoti = false;
        $('#notifications-container-menu').hide();
        $('.noti-status').removeClass('white-font-class');
    }

    if (!container_fixed.is(e.target) && container_fixed.has(e.target).length === 0)
    {
        openNotiFixed = false;
        $('.action-user-center-fixed #notifications-container-menu').hide();
        $('.action-user-center-fixed .noti-status').removeClass('white-font-class');
    }

    $('.btn-lesson-menu').click(function () {
        if($('.type-lesson-header').hasClass('question-header')) {
            var type_question_id = $('.type-lesson-header').data('type-question-id');
            $('.item-type-question-' + type_question_id).addClass('active-custom');
        }
        else if($('.type-lesson-header').hasClass('mix-test-header')) {
            $('.mix-test-lesson-reading').addClass('active-custom');
        }
        else {
            $('.full-test-lesson-reading').addClass('active-custom');
        }
    });

});

$('.noti-status').click(function (e) {
    // alert('match noti');
    e.preventDefault();
    noti_header = $(this).parent('.notification-status');
    noti_fixed_element = $(this).parents('.action-user-center-fixed');
    noti_area = noti_header.find('#listNotiArea');
    noti_container = noti_header.find('#notifications-container-menu');

    if (noti_fixed_element.length > 0) {
        if (!openNotiFixed) {
            openNotiFixed = true;
            $('.action-user-center-fixed #notifications-container-menu').show();
            $(this).addClass('white-font-class');
        }
        else {
            openNotiFixed = false;
            $('.action-user-center-fixed #notifications-container-menu').hide();
            $(this).removeClass('white-font-class');
        }
    }
    else {
        if (!openNoti) {
            openNoti = true;
            noti_container.show();
            $(this).addClass('white-font-class');
        }
        else {
            openNoti = false;
            noti_container.hide();
            $(this).removeClass('white-font-class');
        }
    }

    loadAllNotification(noti_area);
});

function loadAllNotification(noti_area) {
    var ajaxGetNotiUrl = baseUrl + '/getNotification/' + myId;
    $.ajax({
        type: "GET",
        url: ajaxGetNotiUrl,
        dataType: "json",
        success: function (data) {
            noti_area.html('');
            console.log(data);
            var list_notis = data.list_notis;
            if (list_notis.length != 0) {
                for (var i = 0; i < list_notis.length; i++) {
                    console.log('read: ' + list_notis[i].read);
                    if (list_notis[i].read == 0) {
                        var classReadNoti = '';
                    }
                    else {
                        console.log('read !0: ' + list_notis[i].read);
                        var classReadNoti = 'seen-noti';
                    }

                    if (list_notis[i].type_noti == 'userCommentNotification') {
                        var type_noti = 0;
                        var url_link = baseUrl + '/reading/readingViewSolutionLesson/' + list_notis[i].lesson_id + '-' + list_notis[i].quiz_id + '?question=' + list_notis[i].question_id + '&comment=' + list_notis[i].comment_id;
                        var content_noti = '<strong>' + list_notis[i].username_cmt + ' </strong> commented on <strong>' + list_notis[i].lesson_title + ' lesson</strong>';
                        var noti_id = list_notis[i].noti_id;
                    }
                    noti_area.append(
                        '<div class="item-notification no-read ' + classReadNoti + '" onclick="readNotification(' + type_noti + ', ' + noti_id + ')">'
                        + '<a href="' + url_link + '" class="link-to-noti">'
                        + '<span class="img-user-send-noti img-auto-center">'
                        + '<img alt="' + list_notis[i].username_cmt + '" src="/storage/img/users/' + list_notis[i].avatar_user + '" class="img-user-noti-header img-auto-center-inner" />'
                        + '</span>'
                        + '<span class="item-content-noti">'
                        + '<div class="item-body-noti">'
                        +  content_noti
                        + '</div>'
                        + '<div class="item-time-noti">'
                        + '<span class="img-time-noti">'
                        + '<img alt="time-noti" src="/public/imgs/original/time.png" class="img-time-noti" />'
                        + '</span>'
                        + '<span class="time-ago-noti">'
                        + list_notis[i].noti_updated
                        + '</span>'
                        + '</div>'
                        + '</span>'
                        + '<span class="img-auto-center img-lesson-preview">'
                        + '<img alt="' + list_notis[i].lesson_title + '" src="/storage/upload/images/img-feature/' + list_notis[i].image_lesson_feature + '" class="img-lesson-preview-header img-auto-center-inner" />'
                        + '</span>'
                        + '</a>'
                        + '</div>'
                    );
                }
            }
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}

function readNotification(type_noti, id) {
    var ajaxReadNotiUrl = baseUrl + '/readNotification/' + type_noti + '--' + id;
    $.ajax({
        type: "GET",
        url: ajaxReadNotiUrl,
        dataType: "json",
        success: function (data) {
            console.log('Success:', data);
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}

function markAllNotificationAsRead() {
    var ajaxMarkAllNotificationAsRead = baseUrl + '/markAllNotificationAsRead';
    // alert('dasd');/**/
    $.ajax({
        type: "GET",
        url: ajaxMarkAllNotificationAsRead,
        dataType: "json",
        success: function (data) {
            $('sup.total-noti').each(function () {
                $(this).hide();
            });
            $('.item-notification.no-read').each(function () {
                $(this).removeClass('no-read');
                $(this).addClass('seen-noti');
            });
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}
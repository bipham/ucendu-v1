/**
 * Created by BiPham on 9/7/2017.
 */
$(document).ready(function() {
    var nav = $('.menu-reading');
    var body = $('body');
    $(window).scroll(function () {
        if ($(this).scrollTop() > 139) {
            nav.addClass("reading-header-fixed");
            body.addClass("reading");
            $('.left-custom #notifications-container-menu').hide();
            $('.left-custom .noti-status').removeClass('white-font-class');
            openNoti = false;
        } else {
            nav.removeClass("reading-header-fixed");
            body.removeClass("reading");
            $('.action-user-center-fixed #notifications-container-menu').hide();
            $('.action-user-center-fixed .noti-status').removeClass('white-font-class');
            openNotiFixed = false;
        }
    });
});

function playChapter(chapter_id) {
    $('.mejs-playlist li:nth-child(' + chapter_id + ')').click();
}
/**
 * Created by BiPham on 9/4/2017.
 */
jQuery("document").ready(function($){
    var nav = $('.menu-reading');
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

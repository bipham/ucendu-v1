/**
 * Created by nobikun1412 on 27-May-17.
 */
// Notification.requestPermission();
var myId = $('#userNotiAction').data('user-id');
var oldTotalNoti = $('.total-noti').html();
var baseUrl = document.location.origin;
console.log('ID: ' + myId);
console.log('oldTotalNoti: ' + oldTotalNoti);
var baseUrl = document.location.origin;
var socket_connect = baseUrl + ':8890';
var socket = io.connect(socket_connect);
socket.emit('updateSocket', myId);
socket.on('commentNotification', function (data) {
    console.log('data: ' + data);
    var dataJSON = JSON.parse(data);
    var dataUser = dataJSON.user_cmt;
    var readingLesson = dataJSON.readingLesson;
// var url = '#';
    var url = baseUrl + '/reading/readingViewSolutionLesson/' + dataJSON.lesson_id + '-' + dataJSON.quiz_id + '?question=' + dataJSON.question_id + '&comment=' + dataJSON.comment_id;
    var body = dataUser.username + ' commented on ' + readingLesson.title + ' lesson.';

    var img_feature = '/storage/img/users/' + dataUser.avatar;

    var title_noti = 'New notification from Ucendu!';

    var totalNoti = dataJSON.totalNoti;
    if (typeof oldTotalNoti === "undefined") {
        $('.left-custom .print-number-noti').append('<sup class="total-noti">' + totalNoti + '</sup>');
        $('.action-user-center-fixed .print-number-noti').append('<sup class="total-noti">' + totalNoti + '</sup>');
    }
    else {
        $('.left-custom sup.total-noti').html(totalNoti);
        $('.action-user-center-fixed sup.total-noti').html(totalNoti);
    }
    oldTotalNoti = totalNoti;

    if (Notification.permission == 'default')
    {
        alert('Bạn phải cho phép thông báo trên trình duyệt mới có thể hiển thị nó.');
    }
    // Ngược lại đã cho phép
    else
    {
        // Tạo thông báo
        notify = new Notification(
            title_noti,
            {
                body: body,
                icon: img_feature, // Hình ảnh
                tag: url // Đường dẫn
            }
        );

        notify.onclick = function () {
            window.open(this.tag, '_blank');
            // window.location.href = this.tag; // Di chuyển đến trang cho url = tag
            readNotification(0, dataJSON.noti_id);
            window.focus();
        };
    }
});


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
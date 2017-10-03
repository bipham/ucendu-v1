/**
 * Created by BiPham on 8/17/2017.
 */

var i = '';
var idremove = '';
var listHl = [];
var noti = false;
var sandbox = document.getElementById('sandbox');
var boolRemove = false;
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

$(document).on("click", ".remove",function() {
    idremove = $(this).data('removeid');
    noti = false;
    hltr.removeHighlights();
});

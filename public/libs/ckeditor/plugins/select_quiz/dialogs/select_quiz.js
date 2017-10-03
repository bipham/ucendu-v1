CKEDITOR.dialog.add( 'select_quizDialog', function( editor ) {
    return {
        title: 'Select Quiz Properties',
        minWidth: 400,
        minHeight: 200,
        contents: [
            {
                id: 'tab-basic',
                label: 'Basic Settings',
                elements: [
                    {
                        type: 'text',
                        id: 'question',
                        label: 'Question number',
                        validate: CKEDITOR.dialog.validate.notEmpty( "Question number field cannot be empty." )
                    },
                    // {
                    //     type: 'text',
                    //     id: 'content_question',
                    //     label: 'Content question',
                    //     validate: CKEDITOR.dialog.validate.notEmpty( "Content option field cannot be empty." )
                    // },
                    {
                        type: 'text',
                        id: 'number_option',
                        label: 'Number option',
                        validate: CKEDITOR.dialog.validate.notEmpty( "Value number option field cannot be empty." )
                    },
                    {
                        type: 'select',
                        id: 'type_question',
                        label: 'Type question',
                        items: [ [ 'A B C' ], [ '1 2 3' ], [ 'i ii iii' ], [ 'YES NO NOT_GIVEN' ], [ 'TRUE FALSE NOT_GIVEN'] ],
                        'default': 'A B C'
                    }
                ]
            }
        ],
        onOk: function() {
            var dialog = this;
            var data_ques = $('.upload-page-custom').data('idquestion');
            var question_number = dialog.getValueOf( 'tab-basic', 'question' );
            var number_option = dialog.getValueOf( 'tab-basic', 'number_option' );
            // var content_question = dialog.getValueOf( 'tab-basic', 'content_question' );
            var type_question = dialog.getValueOf('tab-basic', 'type_question' );
            var l_option = 'last-option';
            var option = '';
            if (type_question == 'A B C') {
                option = generateAlpha(number_option);
            }
            else if (type_question == '1 2 3') {
                option = generateNumber(number_option);
            }
            else if (type_question == 'YES NO NOT_GIVEN') {
                option = generateYesNoGiven();
            }
            else if (type_question == 'TRUE FALSE NOT_GIVEN') {
                option = generateTrueFalseGiven();
            }
            else {
                option = generateRomanize(number_option);
            }
            var html = '<select class="question-quiz question-select question-' + question_number + ' ' + l_option +'" name="question-' + question_number + '" data-qnumber="' + data_ques +'">' + option + '</select> ';
            data_ques++;
            $('.upload-page-custom').data('idquestion', data_ques);
            editor.insertHtml( html );
        }
    };
});
function generateAlpha(n) {
    var max = 65 + parseInt(n);
    var option = '<option value=""></option>';
    for (var i = 65; i < max; i++) {
        option += '<option value="' + String.fromCharCode(i) + '">' + String.fromCharCode(i) + '</option>';
    }
    return option;
}

function generateNumber(n) {
    var max = 1 + parseInt(n);
    var option = '<option value=""></option>';
    for (var i = 1; i < max; i++) {
        option += '<option value="' + i + '">' + i + '</option>';
    }
    return option;
}

function generateYesNoGiven() {
    var option = '<option value=""></option>'
                + '<option value="YES">YES</option>'
                + '<option value="NO">NO</option>'
                + '<option value="NOT GIVEN">NOT GIVEN</option>';
    return option;
}

function generateTrueFalseGiven() {
    var option = '<option value=""></option>'
        + '<option value="TRUE">TRUE</option>'
        + '<option value="FALSE">FALSE</option>'
        + '<option value="NOT GIVEN">NOT GIVEN</option>';
    return option;
}

function generateRomanize(n) {
    var max = 1 + parseInt(n);
    var option = '<option value=""></option>';
    for (var i = 1; i < max; i++) {
        option += '<option value="' + romanize(i) + '">' + romanize(i) + '</option>';
    }
    return option;
}

function romanize(num) {
    var lookup = {m:1000,cm:900,D:500,cd:400,c:100,xc:90,l:50,xl:40,x:10,ix:9,v:5,iv:4,i:1},
        roman = '',
        i;
    for ( i in lookup ) {
        while ( num >= lookup[i] ) {
            roman += i;
            num -= lookup[i];
        }
    }
    return roman;
}
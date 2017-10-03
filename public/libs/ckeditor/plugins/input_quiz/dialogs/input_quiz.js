CKEDITOR.dialog.add( 'input_quizDialog', function( editor ) {
    return {
        title: 'Input Quiz Properties',
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
                    }
                    // {
                    //     type: 'text',
                    //     id: 'opt_question',
                    //     label: 'Content option',
                    //     validate: CKEDITOR.dialog.validate.notEmpty( "Content option field cannot be empty." )
                    // }
                    // {
                    //     type: 'text',
                    //     id: 'value_question',
                    //     label: 'Value option',
                    //     validate: CKEDITOR.dialog.validate.notEmpty( "Value option field cannot be empty." )
                    // },
                    // {
                    //     type: 'checkbox',
                    //     id: 'last_option',
                    //     label: 'Last option',
                    //     // 'default': 'checked',
                    //     // onClick: function() {
                    //     //     // this = CKEDITOR.ui.dialog.checkbox
                    //     //     alert( 'Checked: ' + this.getValue() );
                    //     // }
                    // }
                ]
            }
        ],
        onOk: function() {
            var dialog = this;
            var data_ques = $('.upload-page-custom').data('idquestion');
            console.log(data_ques);
            var class_quiz = dialog.getValueOf( 'tab-basic', 'question' );
            // var value_quiz = dialog.getValueOf( 'tab-basic', 'value_question' );
            // var opt_quiz = dialog.getValueOf( 'tab-basic', 'opt_question' );
            // var last_option = dialog.getValueOf('tab-basic', 'last_option' );
            var l_option = 'last-option';
            var html = '<span class="label-input key-label"><strong>' + class_quiz + '</strong></span> <input type="text" class="question-quiz question-input question-' + class_quiz + ' ' + l_option +'" name="question-' + class_quiz + '" onclick="bitest(this)" data-qnumber="' + data_ques +'"/>';
            data_ques++;
            $('.upload-page-custom').data('idquestion', data_ques);
            editor.insertHtml( html );
        }
    };
});
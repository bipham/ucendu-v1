/**
 * Created by nobikun1412 on 17-Jun-17.
 */
CKEDITOR.plugins.add( 'checkbox_quiz', {
    icons: 'checkbox_quiz',
    init: function( editor ) {
        //Plugin logic goes here.
        editor.addCommand( 'insertCheckboxQuiz', new CKEDITOR.dialogCommand( 'checkbox_quizDialog' ) );
        editor.ui.addButton( 'checkbox_quiz', {
            label: 'Insert Checkbox Quiz',
            command: 'insertCheckboxQuiz',
            toolbar: 'others,0'
        });
         CKEDITOR.dialog.add( 'checkbox_quizDialog', this.path + 'dialogs/checkbox_quiz.js' );
    }
});
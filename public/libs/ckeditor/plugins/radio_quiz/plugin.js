/**
 * Created by nobikun1412 on 17-Jun-17.
 */
CKEDITOR.plugins.add( 'radio_quiz', {
    icons: 'radio_quiz',
    init: function( editor ) {
        //Plugin logic goes here.
        editor.addCommand( 'insertRadioQuiz', new CKEDITOR.dialogCommand( 'radio_quizDialog' ) );
        editor.ui.addButton( 'radio_quiz', {
            label: 'Insert Radio Quiz',
            command: 'insertRadioQuiz',
            toolbar: 'others,3'
        });
         CKEDITOR.dialog.add( 'radio_quizDialog', this.path + 'dialogs/radio_quiz.js' );
    }
});
/**
 * Created by nobikun1412 on 17-Jun-17.
 */
CKEDITOR.plugins.add( 'input_quiz', {
    icons: 'input_quiz',
    init: function( editor ) {
        //Plugin logic goes here.
        editor.addCommand( 'insertInputQuiz', new CKEDITOR.dialogCommand( 'input_quizDialog' ) );
        editor.ui.addButton( 'input_quiz', {
            label: 'Insert Input Quiz',
            command: 'insertInputQuiz',
            toolbar: 'others,4'
        });
         CKEDITOR.dialog.add( 'input_quizDialog', this.path + 'dialogs/input_quiz.js' );
    }
});
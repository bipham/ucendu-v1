/**
 * Created by nobikun1412 on 17-Jun-17.
 */
CKEDITOR.plugins.add( 'select_quiz', {
    icons: 'select_quiz',
    init: function( editor ) {
        //Plugin logic goes here.
        editor.addCommand( 'insertSelectQuiz', new CKEDITOR.dialogCommand( 'select_quizDialog' ) );
        editor.ui.addButton( 'select_quiz', {
            label: 'Insert Select Quiz',
            command: 'insertSelectQuiz',
            toolbar: 'others,1'
        });
         CKEDITOR.dialog.add( 'select_quizDialog', this.path + 'dialogs/select_quiz.js' );
    }
});
<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
//use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Models\ReadingChapterOfEnglishStory;
use App\Models\ReadingEnglishStory;
use App\Models\ReadingLevelStory;
use App\Models\ReadingGenreStory;
use Illuminate\Support\Facades\File;
use Request;
use Illuminate\Support\Facades\Input;

class ReadingEnglishStoryController extends Controller
{
    public function getUploadReadingStory() {
        $readingEnglishStoryModel = new ReadingEnglishStory();
        $list_stories = $readingEnglishStoryModel->getAllEnglishStory();
        $readingLevelStoryModel = new ReadingLevelStory();
        $levels = $readingLevelStoryModel::select()->get();

        $readingGenreStoryModel = new ReadingGenreStory();
        $genres = $readingGenreStoryModel::select()->get();
        return view('admin.readingUploadNewStory', compact('list_stories', 'levels', 'genres'));
    }

    /**
     * @param ClientUpRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function postCreateNewStory(Request $request)
    {
        if (Request::ajax()) {
            $readingEnglishStoryModel = new ReadingEnglishStory();
            $current_story_id = $readingEnglishStoryModel::orderBy('id', 'desc')->first();

            if ($current_story_id == NULL) {
                $current_story_id = 1;
            }
            else {
                $current_story_id = $current_story_id->id + 1;
            }

            $title_story = $_POST['new_title_story'];
//            $title_story = stripUnicode($new_title_story);
            $author = $_POST['name_author'];
            $level_story = $_POST['level_story'];
            $length_story = $_POST['length_story'];
            $genre_story = $_POST['genre_story'];

            //Save Cover Story
            $img_url_cover = $_POST['img_url_cover'];
            $img_name_cover = $_POST['img_name_cover'];
            $img_name_cover_no_ext = $_POST['img_name_cover_no_ext'];
            $img_name_cover_extension = $_POST['img_name_cover_extension'];
            $img_name_cover = stripUnicode($img_name_cover);
            $img_name_cover_no_ext = stripUnicode($img_name_cover_no_ext);
            $img_name_cover_no_ext = str_replace(" ","_", $img_name_cover_no_ext);

            $base_to_cover = explode(',', $img_url_cover);
            $data_cover = base64_decode($base_to_cover[1]);

            $filepath_cover = base_path() . '\storage\upload\reading-stories\\' . $current_story_id . '-' . $title_story . '\image-cover';

            if (!File::exists($filepath_cover)) {
                File::makeDirectory($filepath_cover, 0777, true, true);
            }

            $img_name_cover_save = $current_story_id . '-' . $img_name_cover_no_ext . '.' . $img_name_cover_extension;

            $filename_img_cover = base_path() . '\storage\upload\reading-stories\\' . $current_story_id . '-' . $title_story . '\image-cover\\' . $img_name_cover_save;

            file_put_contents($filename_img_cover, $data_cover);

            $destination_cover = base_path() . '\storage\upload\reading-stories\\' . $current_story_id . '-' . $title_story . '\image-cover\\' . $img_name_cover_save;

            compressImage($filename_img_cover, $destination_cover);

           //Save Author Avatar:
            $img_url_author = $_POST['img_url_author'];
            $img_name_author = $_POST['img_name_author'];
            $img_name_author_no_ext = $_POST['img_name_author_no_ext'];
            $img_name_author_extension = $_POST['img_name_author_extension'];
            $img_name_author = stripUnicode($img_name_author);
            $img_name_author_no_ext = stripUnicode($img_name_author_no_ext);
            $img_name_author_no_ext = str_replace(" ","_", $img_name_author_no_ext);

            $base_to_author = explode(',', $img_url_author);
            $data_author = base64_decode($base_to_author[1]);

            $filepath_author = base_path() . '\storage\upload\reading-stories\\' . $current_story_id . '-' . $title_story . '\author-avatar';

            if (!File::exists($filepath_author)) {
                File::makeDirectory($filepath_author, 0777, true, true);
            }

            $img_name_author_save = $current_story_id . '-' . $img_name_author_no_ext . '.' . $img_name_author_extension;

            $filename_img_author = base_path() . '\storage\upload\reading-stories\\' . $current_story_id . '-' . $title_story . '\author-avatar\\' . $img_name_author_save;

            file_put_contents($filename_img_author, $data_author);

            $destination_author = base_path() . '\storage\upload\reading-stories\\' . $current_story_id . '-' . $title_story . '\author-avatar\\' . $img_name_author_save;

            compressImage($filename_img_author, $destination_author);

            $story_id = $readingEnglishStoryModel->createNewStory($title_story, $img_name_cover_save, $author, $img_name_author_save, $level_story, $genre_story, $length_story);

            return json_encode(['story_id' => $story_id]);
        }
    }

    public function postCreateNewChapterOfStory(Request $request)
    {
        if (Request::ajax()) {
            $story_id = $_POST['story_id'];
            $title_chapter = $_POST['title_chapter'];
            $order_chapter = $_POST['order_chapter'];
            $number_images_chapter = $_POST['number_images_chapter'];
            if ($number_images_chapter == '') {
                $number_images_chapter = 0;
            }
            $content_chapter = $_POST['content_chapter'];
//            $content_chapter = strip_tags($content_chapter, '<p>');
//            $content_chapter = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $content_chapter);
            $readingChapterOfEnglishStoryModel = new ReadingChapterOfEnglishStory();
            $result = $readingChapterOfEnglishStoryModel->createNewChapterOfStory($story_id, $title_chapter, $number_images_chapter, $order_chapter, $content_chapter);
            return json_encode(['result' => $result]);
        }
    }

    public function getCreateNewLevelStory($domain) {

        return view('admin.readingCreateNewLevelStory');
    }

    public function postCreateNewLevelStory($domain) {
        $readingLevelStoryModel = new ReadingLevelStory();
        $level = Input::get('level');
        $result = $readingLevelStoryModel->createNewLevelStory($level);
        if ($result == 'success') {
            $message = ['flash_level'=>'success message-custom','flash_message'=>'Tạo level story thành công!'];
        }
        else {
            $message = ['flash_level'=>'danger message-custom','flash_message'=>'Level story này đã tồn tại!'];
        }

        return redirect('createNewLevelStory')->with($message);
    }

    public function getCreateNewGenreStory($domain) {

        return view('admin.readingCreateNewGenreStory');
    }

    public function postCreateNewGenreStory($domain) {
        $readingGenreStoryModel = new ReadingGenreStory();
        $genre = Input::get('genre');
        $result = $readingGenreStoryModel->createNewGenreStory($genre);
        if ($result == 'success') {
            $message = ['flash_level'=>'success message-custom','flash_message'=>'Tạo genre story thành công!'];
        }
        else {
            $message = ['flash_level'=>'danger message-custom','flash_message'=>'Genre story này đã tồn tại!'];
        }

        return redirect('createNewGenreStory')->with($message);
    }
}

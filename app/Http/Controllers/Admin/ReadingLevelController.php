<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\ReadingLevel;

class ReadingLevelController extends Controller
{
    public function getCreateNewLevelLesson($domain) {

        return view('admin.readingCreateNewLevelLesson');
    }

    public function postCreateNewLevelLesson($domain) {
        $readingLevelModel = new ReadingLevel();
        $level = Input::get('level');
        $result = $readingLevelModel->createNewLevel($level);
        if ($result == 'success') {
            $message = ['flash_level'=>'success message-custom','flash_message'=>'Tạo level story thành công!'];
        }
        else {
            $message = ['flash_level'=>'danger message-custom','flash_message'=>'Level story này đã tồn tại!'];
        }

        return redirect('createNewLevelLesson')->with($message);
    }
}

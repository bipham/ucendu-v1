<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReadingCategory;
use Request;

class CateController extends Controller
{
    //
    public function createNewCate() {
        if (Request::ajax()) {
            $cateName = $_GET['cateName'];
            $category = new ReadingCategory();
            $cate_id = $category->createNewCategory($cateName);
            return json_encode(['newCate' => $cateName, 'cate_id' => $cate_id]);
        }
//        return "hello";
    }
}

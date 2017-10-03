<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadingCategory extends Model
{
    protected $table = 'reading_categories';

    protected $fillable = ['name', 'level_cate', 'parent_id', 'status'];

    public $timestamps = true;

    public function createNewCategory ($name_cate) {
        $newCate = new ReadingCategory();
        $newCate->name = $name_cate;
        $newCate->save();
        return $newCate->id;
    }

    public function getCateById($cate_id) {
        return $this->select('name')->where('id',$cate_id)
            ->where('status', 1)
            ->first();
    }

    public function getAllLevel() {
        return $this->where('status', 1)->get();
    }
}

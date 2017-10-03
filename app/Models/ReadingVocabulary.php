<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReadingVocabulary extends Model
{
    protected $table = 'reading_vocabularies';

    protected $fillable = ['name', 'icon', 'status'];

    public $timestamps = true;

    public function createNewVocabulary ($name, $icon) {
        $newVocabulary = new ReadingVocabulary();
        $newVocabulary->name = $name;
        $newVocabulary->icon = $icon;
//        $newVocabulary->content = $content;
        $newVocabulary->save();
        return $newVocabulary->id;
    }

    public function getAllVocabulary() {
        return $this->where('status', 1)->get();
    }
}

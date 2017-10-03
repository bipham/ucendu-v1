<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadingTypeQuestion extends Model
{
    protected $table = 'reading_type_questions';

    protected $fillable = ['name', 'introduction', 'status'];

    public $timestamps = true;

    public function getAllTypeQuestion() {
        return $this->where('status', 1)->get();
    }

    public function getAllTypeQuestionId() {
        return $this->where('status', 1)
            ->select('id', 'name')
            ->get();
    }

    public function createNewTypeQuestion ($type_name) {
        $newTypeQuestion = new ReadingTypeQuestion();
        $newTypeQuestion->name = $type_name;
//        $newTypeQuestion->introduction = $introduction;
        $newTypeQuestion->save();
        return $newTypeQuestion->id;
    }

    public function getTypeQuestionById ($id) {
        return $this->where('id',$id)->get()->first();
    }

}

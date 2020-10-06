<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['text', 'type', 'parent_id', 'survey_id'];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}

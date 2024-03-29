<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';

    protected $fillable = [
        'username', 'question_id', 'answer_id', 'answer_value'
    ];
}

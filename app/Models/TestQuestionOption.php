<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestQuestionOption extends Model
{
    use HasFactory;

    protected $fillable = [
        "test_question_id",
        "option",
        "correct_option",
    ];

    public function test_question()
    {
        return $this->belongsTo(TestQuestion::class);
    }
}

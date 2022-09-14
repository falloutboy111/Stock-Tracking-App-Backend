<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestQuestionOption extends Model
{
    use HasFactory;

    protected $fillable = [
        "uuid",
        "test_question_uuid",
        "option",
        "order",
        "correct",
    ];

    public function test_question()
    {
        return $this->belongsTo(TestQuestion::class);
    }
}

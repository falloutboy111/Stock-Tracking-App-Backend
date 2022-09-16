<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    use HasFactory;
    use Uuids;

    protected $fillable = [
        "question",
        "type",
        "test_id",
        "mark",
        "test_uuid",
        "test_section_uuid"
    ];
    
    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function test_question_option()
    {
        return $this->hasMany(TestQuestionOption::class, "test_question_uuid", "uuid")->orderBy("order", "asc");
    }
}

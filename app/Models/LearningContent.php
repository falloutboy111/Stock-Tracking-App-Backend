<?php

namespace App\Models;

use App\Traits\LearningContentTrait;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningContent extends Model
{
    use HasFactory;
    use LearningContentTrait;

    protected $keyType = "string";

    protected $primaryKey = "uuid";

    protected $fillable = [
        "order",
        "content",
        "learning_chapter_uuid",
        "test_uuid",
    ];

    public function chapter()
    {
        return $this->belongsTo(LearningChapter::class);
    }

    public function test()
    {
        return $this->belongsTo(Test::class, "test_uuid", "uuid");
    }
}

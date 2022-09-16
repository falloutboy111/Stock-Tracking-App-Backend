<?php

namespace App\Models;

use App\Http\Controllers\Learning\Chapter;
use App\Traits\LearningChapterTrait;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningChapter extends Model
{
    use HasFactory;
    use LearningChapterTrait;

    protected $keyType = "string";

    protected $primaryKey = "uuid";

    protected $fillable = [
        "title",
        "learning_module_uuid",
    ];

    public function content()
    {
        return $this->hasMany(LearningContent::class);
    }

    public function module()
    {
        return $this->belongsTo(LearningModule::class, "learning_module_uuid", "uuid");
    }
}

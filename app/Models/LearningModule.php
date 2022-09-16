<?php

namespace App\Models;

use App\Http\Controllers\Learning\Content;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningModule extends Model
{
    use HasFactory;
    use Uuids;

    protected $keyType = "string";

    protected $primaryKey = "uuid";

    protected $fillable = [
        "title"
    ];

    public function chapter()
    {
        return $this->hasMany(LearningChapter::class);
    }
}

<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningMaterial extends Model
{
    use HasFactory;
    use Uuids;

    protected $keyType = "string";

    protected $primaryKey = "uuid";

    protected $fillable = [
        "content",
        "section_number",
        "is_image",
        "image_src",
        "test_question"
    ];

    public function learning_content()
    {
        return $this->belongsTo("learning_content", "content_uuid", "uuid");
    }
}

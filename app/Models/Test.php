<?php

namespace App\Models;

use App\Casts\AllocatedUserCast;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    use Uuids;

    protected $fillable = [
        "name",
        "total",
        "allocated_users",
    ];

    protected $casts = [
        "allocated_users" => AllocatedUserCast::class,
    ];

    public function test_question()
    {
        return $this->hasMany(TestQuestion::class, "test_uuid", "uuid");
    }

    public function user_type()
    {
        return $this->belongsToMany(UserType::class, null, "test_uuid", "user_type_uuid", "uuid", "uuid", "uuid");
    }

    public function content()
    {
        return $this->hasMany(LearningContent::class, "learning_content_uuid", "uuid");
    }
}

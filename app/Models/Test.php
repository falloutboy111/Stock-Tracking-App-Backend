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
}

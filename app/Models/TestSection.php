<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSection extends Model
{
    use HasFactory;
    use Uuids;

    protected $fillable = [
        'name',
        'test_uuid',
    ];

    public function test()
    {
        return $this->belongsTo(Test::class, "test_uuid", "uuid");
    }

    public function test_questions()
    {
        return $this->hasMany(TestQuestion::class, "test_section_uuid", "uuid");
    }
}

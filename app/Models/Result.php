<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "test_id",
        "mark",
    ];

    public function test()
    {
        return $this->hasOne(Test::class);
    }

    public function staff()
    {
        return $this->hasMany(staff::class);
    }
}

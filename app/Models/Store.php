<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    use Uuids;

    protected $fillable = [
        "name",
        "mall_id",
    ];

    public function mall()
    {
        return $this->belongsToMany(Mall::class, null, "store_uuid", "mall_uuid", "uuid", "uuid", "uuid");
    }

    public function staff()
    {
        return $this->belongsToMany(Staff::class, null, "store_uuid", "staff_uuid", "uuid", "uuid", "uuid");
    }
}

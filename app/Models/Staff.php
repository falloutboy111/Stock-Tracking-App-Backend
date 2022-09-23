<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Staff extends Model
{
    use HasFactory;
    use Uuids;
    use HasRoles;

    protected $fillable = [
        'first_name',
        'last_name',
        "username",
        "password"
    ];

    protected $guard_name = 'web';

    public function brand()
    {
        return $this->belongsToMany(Brand::class, null, "staff_uuid", "brand_uuid", "uuid", "uuid", "uuid");
    }

    public function store()
    {
        return $this->belongsToMany(Store::class, null, "staff_uuid", "store_uuid", "uuid", "uuid", "uuid");
    }

}

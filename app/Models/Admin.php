<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Model
{
    use HasFactory;
    use HasRoles;
    use Uuids;

    protected $fillable = [
        'first_name',
        'last_name',
        'employee_id',
        "username",
        "password"
    ];

    protected $guard_name = 'web';

    public function brand()
    {
        return $this->belongsToMany(Brand::class, null, "admin_uuid", "brand_uuid", "uuid", "uuid", "uuid");
    }

    public function store()
    {
        return $this->belongsToMany(Store::class, null, "admin_uuid", "store_uuid", "uuid", "uuid", "uuid"); //belongs to many stores
    }
}

<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
    use HasFactory;
    use Uuids;

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    protected $fillable = [
        "name",
        "region_uuid",
    ];

    public function store()
    {
        return $this->belongsToMany(Store::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}

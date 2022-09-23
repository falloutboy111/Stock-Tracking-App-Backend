<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model
{
    use HasFactory;
    use Uuids;

    protected $fillable = [
        "name",
        "limit"
    ];

    protected $primaryKey = "uuid";
    protected $keyType = "string";

    public function store()
    {
        return $this->hasMany(Store::class);
    }
}

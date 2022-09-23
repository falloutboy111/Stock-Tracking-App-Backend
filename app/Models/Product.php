<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use Uuids;

    protected $fillable = [
        "name",
        "barcode",
        "product_group_uuid"
    ];

    protected $primaryKey = "uuid";
    protected $keyType = "string";
}

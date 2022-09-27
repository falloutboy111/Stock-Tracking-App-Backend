<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use Uuids;

    protected $primaryKey = "uuid";
    protected $keyType = "string";

    protected $fillable = [
        "notes",
        "status",
        "store_uuid"
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

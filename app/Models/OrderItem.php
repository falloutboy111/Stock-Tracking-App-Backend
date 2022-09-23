<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    use Uuids;

    protected $primaryKey = "uuid";
    protected $keyType = "string";

    protected $fillable = [
        "order_uuid",
        "product_uuid",
        "quantity"
    ];

    public function order_items()
    {
        return $this->belongsTo(Order::class);
    }
}

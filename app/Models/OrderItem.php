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
        "uuid",
        "order_uuid",
        "product_uuid",
        "quantity"
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

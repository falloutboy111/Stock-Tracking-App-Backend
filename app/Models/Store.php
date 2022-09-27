<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    use Uuids;

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    protected $fillable = [
        "name",
        "mall_uuid",
        "product_group_uuid",
    ];

    public function mall()
    {
        return $this->belongsTo(Mall::class);
    }

    public function staff()
    {
        return $this->belongsToMany(Staff::class, null, "store_uuid", "staff_uuid", "uuid", "uuid", "uuid");
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function product_group()
    {
        return $this->belongsTo(ProductGroup::class);
    }
}

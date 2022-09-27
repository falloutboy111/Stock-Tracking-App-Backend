<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Region extends Model
{
    use HasFactory;

    use Uuids;

    protected $primaryKey = "uuid";
    protected $keyType = "string";

    protected $fillable = [
        "name",
    ];

    public function getNamePrettyAttribute()
    {
        return ucfirst(implode(" ", Str::ucsplit(Str::camel($this->name))));
    }
}

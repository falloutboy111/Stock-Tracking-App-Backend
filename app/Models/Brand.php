<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    use Uuids;

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    protected $fillable = [
        "name"
    ];

    public function manager()
    {
        return $this->hasMany(Manager::class);
    }
}

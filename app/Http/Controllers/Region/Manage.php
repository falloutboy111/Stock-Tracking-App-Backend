<?php

namespace App\Http\Controllers\Region;

use App\Http\Controllers\Controller;
use App\Http\Resources\Region\RegionResource;
use App\Models\Region;
use Illuminate\Http\Request;

class Manage extends Controller
{
    public function get()
    {
        return response(RegionResource::collection(Region::get()));
    }
}

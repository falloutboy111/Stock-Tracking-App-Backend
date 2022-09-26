<?php

namespace App\Http\Resources\Staff;

use App\Http\Resources\Brand\BrandResource;
use App\Http\Resources\Store\StoreResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "uuid" => $this->uuid,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "username" => $this->username,
            "store" => StoreResource::collection($this->store),
            "brands" => BrandResource::collection($this->brand),
        ];
    }
}

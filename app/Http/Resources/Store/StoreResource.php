<?php

namespace App\Http\Resources\Store;

use App\Http\Resources\ProductGroup\ProductGroupResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
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
            "name" => $this->name,
            "mall" => $this->mall,
            "staff" => $this->staff,
            "product_group" => new ProductGroupResource($this->product_group),
        ];
    }
}

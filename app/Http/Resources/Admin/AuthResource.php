<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\Brand\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $brands = $this->brand;

        if ($this->hasAnyRole(["super-admin"])) {
            $brands = Brand::get();
        }

        return [
            "name" => $this->name,
            "brands" => BrandResource::collection($brands),
        ];
    }
}

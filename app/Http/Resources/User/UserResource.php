<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Store\StoreResource;
use App\Models\Store;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "email" => $this->email,
            "is_admin" => 1,
            "store" => StoreResource::collection(Store::get()),
        ];
    }
}

<?php

namespace App\Http\Resources\Mall;

use Illuminate\Http\Resources\Json\JsonResource;

class MallResource extends JsonResource
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
            "stores" => $this->store,
        ];
    }
}

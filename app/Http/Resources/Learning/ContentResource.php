<?php

namespace App\Http\Resources\Learning;

use App\Http\Resources\TestResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ContentResource extends JsonResource
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
            "order" => $this->order,
            "content" => $this->content,
            "test" => new TestResource($this->test),
        ];
    }
}

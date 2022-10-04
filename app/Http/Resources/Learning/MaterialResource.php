<?php

namespace App\Http\Resources\Learning;

use Illuminate\Http\Resources\Json\JsonResource;

class MaterialResource extends JsonResource
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
            "id" => $this->uuid, 
            "content" => $this->content,
            "section_number" => $this->section_number,
            "is_image" => $this->is_image,
            "image_src" => $this->image_src,
            "test_question" => $this->test_question,
        ];
    }
}

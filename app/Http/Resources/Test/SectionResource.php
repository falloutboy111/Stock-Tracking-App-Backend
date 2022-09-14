<?php

namespace App\Http\Resources\Test;

use App\Http\Resources\TestQuestionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
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
            "name" => $this->name,
            "test" => $this->test,
            "test_questions" => TestQuestionResource::collection($this->test_questions)
        ];
    }
}

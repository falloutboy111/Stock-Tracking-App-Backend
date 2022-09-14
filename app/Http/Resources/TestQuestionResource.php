<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TestQuestionResource extends JsonResource
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
            "question" => $this->question,
            "type" => $this->type,
            "mark" => $this->mark,
            "test_options" => TestQuestionOptionResource::collection($this->test_question_option->orderBy("order", "asc")),
        ];
    }
}

<?php

namespace App\Http\Requests\LearningMaterial;

use App\Rules\LearningMaterialContentNotTogetherWithRule;
use App\Rules\LearningMaterialImageNotTogetherWithRule;
use App\Rules\LearningMaterialNotTogetherWithRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "content" => ["required_without:is_image", "string", new LearningMaterialContentNotTogetherWithRule()],
            "section_number" => ["required", "integer"],
            "is_image" => ["required_without:content", "boolean", new LearningMaterialImageNotTogetherWithRule()],
            "image_src" => ["required_with:is_image", "string"],
        ];
    }
}

<?php

namespace App\Http\Requests\LearningMaterial;

use App\Models\LearningMaterial;
use App\Rules\LearningMaterialContentNotTogetherWithRule;
use App\Rules\LearningMaterialImageNotTogetherWithRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    protected $learning_material;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!$this->learning_material = LearningMaterial::find(request("material"))) {
            return false;
        }

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
            "content" => ["nullable", "string", new LearningMaterialContentNotTogetherWithRule()],
            "section_number" => ["nullable", "integer"],
            "is_image" => ["nullable", "boolean", new LearningMaterialImageNotTogetherWithRule()],
            "image_src" => ["nullable", "string"],
        ];
    }

    public function getLearningMaterial()
    {
        return $this->learning_material;
    }
}

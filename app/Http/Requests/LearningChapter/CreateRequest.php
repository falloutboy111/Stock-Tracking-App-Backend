<?php

namespace App\Http\Requests\LearningChapter;

use App\Models\LearningModule;
use App\Models\Test;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            "title" => ["required", "string"],
            "learning_module_uuid" => ["required", "uuid", Rule::exists(LearningModule::class, "uuid")],
            "test_uuid" => ["nullable", "uuid", Rule::exists(Test::class, "uuid")],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            "learning_module_uuid" => request("module_id"),
        ]);
    }
}

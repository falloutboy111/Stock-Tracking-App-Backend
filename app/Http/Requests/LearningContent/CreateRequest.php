<?php

namespace App\Http\Requests\LearningContent;

use App\Models\LearningChapter;
use App\Models\LearningContent;
use App\Models\Test;
use App\Rules\CheckContentTestRule;
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
            "content" => ["required_without:test_uuid", "string"],
            "learning_chapter_uuid" => ["required", "uuid", Rule::exists(LearningChapter::class, "uuid")],
            "test_uuid" => ["required_without:content", "uuid", Rule::exists(Test::class, "uuid"), new CheckContentTestRule(), Rule::unique(LearningContent::class, "test_uuid")],
        ];
    }
}

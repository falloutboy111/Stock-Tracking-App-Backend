<?php

namespace App\Http\Requests\LearningContent;

use App\Models\LearningChapter;
use App\Models\LearningContent;
use App\Models\Test;
use App\Rules\CheckContentTestRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    protected $content;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!$this->content = LearningContent::find(request("id"))) {
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
            "content" => ["nullable", "string"],
            "learning_chapter_uuid" => ["required", "uuid", Rule::exists(LearningChapter::class, "uuid")],
            "test_uuid" => ["nullable", "uuid", Rule::exists(Test::class, "uuid"), new CheckContentTestRule(), Rule::unique(LearningContent::class, "test_uuid")],
        ];
    }

    public function get_learning_content()
    {
        return $this->content;
    }
}
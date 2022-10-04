<?php

namespace App\Http\Requests\LearningChapter;

use App\Models\LearningChapter;
use App\Models\Test;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{

    protected $chapter;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        if (!$this->chapter = LearningChapter::find(request("chapter"))) {
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
            "title" => ["nullable", "string"],
            "test_uuid" => ["nullable", "uuid", Rule::exists(Test::class, "uuid")],
        ];
    }

    public function get_chapter()
    {
        return $this->chapter;
    }
}

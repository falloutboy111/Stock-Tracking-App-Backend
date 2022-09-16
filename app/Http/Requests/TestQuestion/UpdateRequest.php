<?php

namespace App\Http\Requests\TestQuestion;

use App\Models\TestQuestion;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    protected $test_question;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!$test_question = TestQuestion::where(["uuid" => request("manage")])->first()) {
            return false;
        }

        $this->test_question = $test_question;

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
            "question" => ["required", "string"],
            "type" => ["required", "string", Rule::in(["radio", "check", "text"])],
            "mark" => ["required", "integer"],
            "test_question_option" => ["nullable", "array"],
            "test_question_option.*.option" => ["required", "string"],
            "test_question_option.*.correct" => ["required", "boolean"],
            "test_question_option.*.order" => ["required", "integer"],
        ];
    }

    public function test_question_object()
    {
        return $this->test_question;
    }
}

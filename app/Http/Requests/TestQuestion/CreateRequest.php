<?php

namespace App\Http\Requests\TestQuestion;

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
            "question" => ["required", "string"],
            "type" => ["required", "string", Rule::in(["radio", "check", "text"])],
            "mark" => ["required", "integer"],
            "test_uuid" => ["required", Rule::exists(Test::class, "uuid")],
        ];
    }
}

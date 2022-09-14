<?php

namespace App\Http\Requests\TestSection;

use App\Models\TestSection;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    protected $test_section;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!$test_section = TestSection::where(["uuid" => request("test_section")])->first()) {
            return false;
        }

        $this->test_section = $test_section;

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
            "name" => "nullable|string"
        ];
    }

    public function test_section_object()
    {
        return $this->test_section;
    }
}

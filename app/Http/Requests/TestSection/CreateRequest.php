<?php

namespace App\Http\Requests\TestSection;

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
            "name" => "required|string",
            "test_uuid" => "required|uuid",
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(["test_uuid" => request("test_uuid")]);
    }
}

<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin;
use App\Rules\UsernameUniqueRule;
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
            "first_name" => ["required", "string"],
            "last_name" => ["nullable", "string"],
            "employee_id" => ["required", "string"],
            "username" => ["required", "string", new UsernameUniqueRule()],
            "password" => [
                "required", "string",
                'min:10',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ]
        ];
    }
}

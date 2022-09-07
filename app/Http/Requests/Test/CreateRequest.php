<?php

namespace App\Http\Requests\Test;

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
            "name" => ["required", "string", Rule::unique(Test::class)],
            "allocated_users" => ["required", "array"],
            "allocated_users.*" => ["required", "string", Rule::in(["brand-manager", "admin", "manager", "staff"])]
        ];
    }
}

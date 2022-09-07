<?php

namespace App\Http\Requests\Test;

use App\Models\Test;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    protected $test;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!$test = Test::where(["uuid" => request("test")])->first()) {
            return false;
        }

        $this->test = $test;

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
            "name" => ["nullable", "string", Rule::unique(Test::class)->whereNot("name", request("name"))],
            "allocated_users" => ["nullable"],
            "allocated_users.*" => ["required", "string", Rule::in(["brand-manager", "admin", "manager", "staff"])]
        ];
    }

    public function test_object()
    {
        return $this->test;
    }
}

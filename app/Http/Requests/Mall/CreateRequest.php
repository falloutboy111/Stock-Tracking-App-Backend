<?php

namespace App\Http\Requests\Mall;

use App\Models\Mall;
use App\Models\Region;
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
            "name" => ["required", "string", Rule::unique(Mall::class)],
            "region_uuid" => ["required", Rule::exists(Region::class, "uuid")]
        ];
    }
}

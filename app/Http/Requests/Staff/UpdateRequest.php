<?php

namespace App\Http\Requests\Staff;

use App\Models\Brand;
use App\Models\Staff;
use App\Models\Store;
use App\Models\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    protected $user_object;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!$user = Staff::where(["uuid" => request("staff")])->first()) {
            return false;
        }

        $this->user_object = $user;

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
            "first_name" => ["nullable", "string"],
            "last_name" => ["nullable", "string"],
            "employee_id" => ["nullable", "string"],
            "brands" => ["nullable", "array"],
            "brands.*" => ["required", "uuid", Rule::exists(Brand::class, "uuid")],
            "stores" => ["nullable", "array"],
            "stores.*" => ["required", "uuid", Rule::exists(Store::class, "uuid")],
            "user_type_uuid" => ["nullable", "uuid", Rule::exists(UserType::class, "uuid")]
        ];
    }

    public function user_object()
    {
        return $this->user_object;
    }
}

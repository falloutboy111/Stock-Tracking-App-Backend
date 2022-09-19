<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;

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
        if (!$user = Admin::where(["uuid" => request("admin")])->first()) {
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
            "password" => ["nullable", "string"],
            "employee_id" => ["nullable", "string"],
        ];
    }

    public function user_object()
    {
        return $this->user_object;
    }
}

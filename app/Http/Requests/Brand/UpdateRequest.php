<?php

namespace App\Http\Requests\Brand;

use App\Models\Brand;
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
        if (!$user = Brand::where(["uuid" => request("mall")])->first()) {
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
            "name" => ["nullable", "string"],
        ];
    }

    public function user_object()
    {
        return $this->user_object;
    }
}

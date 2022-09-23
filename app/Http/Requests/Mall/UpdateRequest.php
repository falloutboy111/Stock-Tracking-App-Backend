<?php

namespace App\Http\Requests\Mall;

use App\Models\Mall;
use App\Rules\UpdateNameRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    protected $mall_object;
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!$mall = Mall::where(["uuid" => request("mall")])->first()) {
            return false;
        }

        $this->mall_object = $mall;

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
            "name" => ["nullable", "string", new UpdateNameRule($this->mall_object)],
        ];
    }

    public function mall_object()
    {
        return $this->mall_object;
    }
}

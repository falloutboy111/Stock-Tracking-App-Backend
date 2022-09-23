<?php

namespace App\Http\Requests\ProductGroup;

use App\Models\ProductGroup;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    protected $product_group_obj;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!$this->product_group_obj = ProductGroup::where(["uuid" => request("product_group")])->first()) {
            return false;
        }

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
            "name" => "nullable|string",
            "limit" => "nullable|integer",
        ];
    }

    public function getProductGroup()
    {
        return $this->product_group_obj;
    }
}

<?php

namespace App\Http\Requests\Store;

use App\Models\Brand;
use App\Models\Mall;
use App\Models\ProductGroup;
use App\Models\Store;
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
            "name" => ["required", "string", Rule::unique(Store::class)],
            "mall_uuid" => ["required", "uuid", Rule::exists(Mall::class, "uuid")],
            "product_group_uuid" => ["required", Rule::exists(ProductGroup::class, "uuid")]
        ];
    }
}

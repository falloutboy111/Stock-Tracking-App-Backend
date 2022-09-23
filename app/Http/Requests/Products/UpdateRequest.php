<?php

namespace App\Http\Requests\Products;

use App\Models\Product;
use App\Models\ProductGroup;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{

    protected $product_obj;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!$this->product_obj = Product::where(["uuid" => request("product")])->first()) {
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
            "name" => "required|string",
            "barcode" => "required|string",
        ];
    }

    public function getProduct()
    {
        return $this->product_obj;
    }
}

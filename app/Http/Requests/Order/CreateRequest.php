<?php

namespace App\Http\Requests\Order;

use App\Models\Product;
use App\Rules\CreateStoreRule;
use App\Rules\OrderItemProductRule;
use App\Rules\OrderItemQuantityRule;
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
            "notes" => ["nullable", "string"],
            "store_uuid" => ["required", new CreateStoreRule()],
            "order_items" => ["required", "array"],
            "order_items.*.product_uuid" => ["required", Rule::exists(Product::class, "uuid")],
            "order_items.*.quantity" => ["required", "integer", new OrderItemQuantityRule()],
        ];
    }

    public function prepareForValidation()
    {
        $user = request("user");

        if ($user->hasRole("staff")) {
            $this->merge(["store_uuid" => $user->store->uuid]);
        }
    }
}
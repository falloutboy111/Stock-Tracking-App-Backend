<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OrderItemQuantityRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $order_items = collect(request("order_items"));

        $quantity = $order_items->where(["product_uuid" => $value]);

        print_r($order_items);
        die;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Quantity exceded for this product.';
    }
}

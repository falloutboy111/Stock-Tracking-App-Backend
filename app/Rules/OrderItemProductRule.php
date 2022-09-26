<?php

namespace App\Rules;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Store;
use Illuminate\Contracts\Validation\Rule;

class OrderItemProductRule implements Rule
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
        $user = request("user");

        $store = Store::where(["uuid" => request("store_uuid")])->first();

        $orders = Order::where(["store_uuid" => request("store_uuid")])->get();


        

        $store_amount = $store->product_group->limit;

        $order_items = OrderItem::where(["product_uuid" => $value])->get();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}

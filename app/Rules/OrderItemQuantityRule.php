<?php

namespace App\Rules;

use App\Models\OrderItem;
use App\Models\Store;
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
        $user = request("user");

        $store = Store::where(["uuid" => request("store_uuid")])->first() ?? null;

        if (!$store) {
            return false;
        }

        $existing_amount = 0;

        if (filled($store->order)) {
            foreach ($store->order as $order) {

                if ($order->approved != "approved") {
                    continue;
                }

                foreach ($order->order_items as $item) {
                    $existing_amount += $item->quantity;
                }
            }
        }

        $store_amount = $store->product_group->limit;

        $compair_amount = $existing_amount + $value;

        if ($compair_amount > $store_amount) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Quantity exceded for this store.';
    }
}

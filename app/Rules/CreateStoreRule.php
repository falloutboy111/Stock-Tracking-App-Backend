<?php

namespace App\Rules;

use App\Models\Store;
use Illuminate\Contracts\Validation\Rule;

class CreateStoreRule implements Rule
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

        if ($user->hasRole("staff")) {
            return true;
        }

        if ($user->hasRole("super-admin")) {
            $stores = collect(Store::get()->toArray());
        } else {
            $stores = collect($user->store);
        }

        $check = 0;

        foreach ($stores as $store ) {
            if ($store["uuid"] == $value) {
                $check = 1;
                break;
            }
        }



        if (!$check) {
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
        return 'Store doesnt exist or user is not authorized to access this store.';
    }
}

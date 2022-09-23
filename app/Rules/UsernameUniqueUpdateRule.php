<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Admin;
use App\Models\Staff;
use App\Models\User;

class UsernameUniqueUpdateRule implements Rule
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
        if (
            ($user = User::where(["email" => request("username")])->first()) ||
            ($user = Admin::where(["username" => request("username")])->first()) ||
            ($user = Staff::where(["username" => request("username")])->first())
        ) {

            if ($user->uuid != request("staff")) {
                return false;
            }
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
        return 'The username has already been taken.';
    }
}

<?php

namespace App\Rules;

use App\Models\Manager;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class UsernameUniqueRule implements Rule
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
            ($user = Manager::where(["username" => request("username")])->first()) ||
            ($user = Staff::where(["username" => request("username")])->first())
        ) {
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
        return 'The username has already been taken.';
    }
}

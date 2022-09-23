<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UpdateNameRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private $obj)
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
        if ($value == $this->obj->name) {
            return true;
        } elseif ($this->obj->where(["name" => $value])->first()) {
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
        return 'Name has already been taken.';
    }
}

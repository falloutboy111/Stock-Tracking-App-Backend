<?php

namespace App\Http\Requests;

use App\Models\Manager;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (
            !($user = User::where(["email" => request("username")])->first()) &&
            !($user = Manager::where(["username" => request("username")])->first()) &&
            !($user = Staff::where(["username" => request("username")])->first())
        ) {
            return false;
        }

        if (!Hash::check(request("password"), $user->password ?? null)) {
            return false;
        }

        $this->user_object = $user;

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
            "username" => ["required"],
            "password" => [
                "required",
                'string',
            ],
        ];
    }

    public function user_obj()
    {
        return $this->user_object;
    }
}

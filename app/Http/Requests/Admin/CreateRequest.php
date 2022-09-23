<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Store;
use App\Rules\UsernameUniqueRule;
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
            "first_name" => ["required", "string"],
            "last_name" => ["nullable", "string"],
            "username" => ["required", "string", new UsernameUniqueRule()],
            "password" => [
                "required", "string",
                'min:10',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
            "brands" => ["required", "array"],
            "brands.*" => ["required", "uuid", Rule::exists(Brand::class, "uuid")],
            "stores" => ["required", "array"],
            "stores.*" => ["required", "uuid", Rule::exists(Store::class, "uuid")],
            // "region" => ["required", Rule::in([

            //     Eastern Cape
            //     Free State
            //     Gauteng
            //     KwaZulu-Natal
            //     Limpopo
            //     Mpumalanga
            //     Northern Cape
            //     North West
            //     Western Cape


            // ])]




        ];
    }
}

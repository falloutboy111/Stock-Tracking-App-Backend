<?php

namespace App\Http\Requests\Store;

use App\Models\Mall;
use App\Models\ProductGroup;
use App\Models\Store;
use App\Rules\UpdateNameRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    protected $store_object;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!$store = Store::where(["uuid" => request("store")])->first()) {
            return false;
        }

        $this->store_object = $store;

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
            "name" => ["nullable", "string", new UpdateNameRule($this->store_object)],
            "malls" => ["nullable", "array"],
            "malls.*" => ["required", "uuid", Rule::exists(Mall::class, "uuid")],
            "product_group_uuid" => ["required", Rule::exists(ProductGroup::class, "uuid")]
        ];
    }

    public function store_object()
    {
        return $this->store_object;
    }
}

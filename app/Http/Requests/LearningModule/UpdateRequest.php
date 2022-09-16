<?php

namespace App\Http\Requests\LearningModule;

use App\Models\LearningModule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    protected $learning_module;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        if (!$this->learning_module = LearningModule::find(request("module"))) {
            return false;
        }

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
            "title" => ["nullable", "string"]
        ];
    }

    public function getLearningModule()
    {
        return $this->learning_module;
    }
}

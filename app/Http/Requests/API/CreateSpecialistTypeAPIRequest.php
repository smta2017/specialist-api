<?php

namespace App\Http\Requests\API;

use App\Helpers\ApiResponse;
use App\Models\SpecialistType;
use Illuminate\Contracts\Validation\Validator;
use InfyOm\Generator\Request\APIRequest;

class CreateSpecialistTypeAPIRequest extends APIRequest
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
     * @return array
     */
    public function rules()
    {
        return SpecialistType::$rules;
    }

    protected function failedValidation(Validator $validator)
    {
        ApiResponse::apiFormatValidation($validator);
    }
}

<?php

namespace App\Http\Requests\API;

use App\Helpers\ApiResponse;
use App\Models\Order;
use Illuminate\Contracts\Validation\Validator;
use InfyOm\Generator\Request\APIRequest;

class CreateOrderAPIRequest extends APIRequest
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
        return Order::$rules;
    }  
    
    protected function failedValidation(Validator $validator)
    {
        ApiResponse::apiFormatValidation($validator);
    }
}

<?php

namespace App\Http\Requests\API;

use App\Helpers\ApiResponse;
use App\Models\OrderComment;
use Illuminate\Contracts\Validation\Validator;
use InfyOm\Generator\Request\APIRequest;

class UpdateOrderCommentAPIRequest extends APIRequest
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
        $rules = OrderComment::$rules;
        
        return $rules;
    }
    
    protected function failedValidation(Validator $validator)
    {
        ApiResponse::apiFormatValidation($validator);
    }
}

<?php

namespace App\Http\Requests\Auth;

use App\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        $unique = '';
        if (env("APP_ENV") == 'production') {
            $unique = '|unique:users';
        }
        return [
            'name' => 'required|min:3|max:80',
            'email' => 'email|required|email|unique:users',
            'phone' => 'required|size:11'  . $unique,
            'password' => 'required|min:8',
            'user_type_id' => 'required'
        ];
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        ApiResponse::apiFormatValidation($validator);
    }
}

<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
    public function rules():array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8|max:18'
        ];
    }

    /**
     * Get the validation error messages.
     *
     * @return array
     */
    public function messages():array
    {
        return [
            'email.required' => __("AuthApi.mustBe.required"),
            'email.email' => __("AuthApi.mustBe.email"),
            'password.required' => __("AuthApi.mustBe.required"),
            'password.min' => __("AuthApi.mustBe.passwordLenMin"),
            'password.max' => __("AuthApi.mustBe.passwordLenMax"),
        ];
    }
}

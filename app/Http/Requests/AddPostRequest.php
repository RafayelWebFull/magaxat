<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class AddPostRequest extends FormRequest
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
        return [
            'post_title' => ['required', 'string'],
            'post_description' => ['sometimes', 'nullable', 'string'],
            'post_image' => ['max:2048', 'mimes:png,jpg,jpeg'],
            'post_video' => ['max:10500', 'mimes:mp4,mov,ogg,qt'],
            'country' => ['string', Rule::exists('countries', 'id')]
        ];
    }

    public function withValidator(Validator $validator)
    {
        if ($validator->fails()) {
            $validator->after(function (Validator $validator) {
                $validator->errors()->add('modalType', 'postsModal');
            });
        }
    }   
}

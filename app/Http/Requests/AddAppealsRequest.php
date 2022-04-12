<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class AddAppealsRequest extends FormRequest
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
            'appeal_title' => ['required', 'string'],
            'appeal_description' => ['required', 'string'],
            'appeal_image' => ['required', 'array'],
            'appeal_image.*' => ['max:2048', 'mimes:png,jpg,jpeg'],
            'appeal_video' => ['max:10240', 'mimes:mp4,mov,ogg,qt'],
            'appeal_pdf' => ['max:1024', 'mimes:pdf'],
        ];
    }

    public function withValidator(Validator $validator)
    {
        if ($validator->fails()) {
            $validator->after(function (Validator $validator) {
                $validator->errors()->add('modalType', 'appealsModal');
            });
        }
    }
}

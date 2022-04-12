<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppealRequest extends FormRequest
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
            'appeal_image' => ['array'],
            'appeal_image.*' => ['max:2048', 'mimes:png,jpg,jpeg'],
            'appeal_video' => ['max:10240', 'mimes:mp4,mov,ogg,qt'],
            'appeal_pdf' => ['max:1024', 'mimes:pdf'],
        ];
    }
}

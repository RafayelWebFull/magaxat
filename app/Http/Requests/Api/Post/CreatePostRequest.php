<?php

namespace App\Http\Requests\Api\Post;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'sometimes|max:2048|mimes:png,jpg,jpeg',
            'video' => 'sometimes|max:7168|mimes:mp4,mov,ogg,qt',
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
            'title.required' => __("AuthApi.mustBe.required"),
            'description.required' => __("AuthApi.mustBe.required"),
            'image.max' => __("AuthApi.mustBe.imageMax"),
            'image.mimes' => __("AuthApi.mustBe.imageMime"),
            'video.max' => __("AuthApi.mustBe.videoMax"),
            'video.mimes' => __("AuthApi.mustBe.videoMime"),
        ];
    }
}

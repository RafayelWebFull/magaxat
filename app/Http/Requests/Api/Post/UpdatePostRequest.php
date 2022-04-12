<?php

namespace App\Http\Requests\Api\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        if(auth()->id() === $this->user->id){
            return true;
        }
        return parent::authorize();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        return [
            'title' => 'sometimes|string',
            'description' => 'sometimes|string',
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
            'image.max' => __("AuthApi.mustBe.imageMax"),
            'image.mimes' => __("AuthApi.mustBe.imageMime"),
            'video.max' => __("AuthApi.mustBe.videoMax"),
            'video.mimes' => __("AuthApi.mustBe.videoMime"),
        ];
    }
}

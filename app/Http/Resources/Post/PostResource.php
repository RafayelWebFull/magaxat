<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\BaseResource;
use App\Http\Resources\Comment\CommentCollection;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;

class PostResource extends BaseResource
{
    public static function collection($resource)
    {
        return tap(new PostCollection($resource), function ($collection) {
            $collection->collects = __CLASS__;
        });
    }

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request):array
    {
        return $this->filterFields([
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'video' => $this->video,
            'comments' => CommentResource::collection($this->whenLoaded('comments'))->hide([
                'updated_at'
            ]),
            'user' => UserResource::make($this->whenLoaded('user'))->hide([
                'phone_number',
                'type',
                'age',
                'gender',
                'date_of_birth',
                'organisation_description',
                'email_verified',
                'created_at',
                'updated_at',
                'additional_type',
                'interesting_type_id',
            ]),
            'created_at' => $this->created_at->format('d/m/Y H:m'),
            'updated_at' => $this->updated_at->format('d/m/Y H:m'),
        ]);
    }
}

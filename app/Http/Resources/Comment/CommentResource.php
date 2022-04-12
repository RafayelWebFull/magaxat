<?php

namespace App\Http\Resources\Comment;

use App\Http\Resources\BaseResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;

class CommentResource extends BaseResource
{
    public static function collection($resource)
    {
        return tap(new CommentCollection($resource), function ($collection) {
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
            'user' => UserResource::make($this->user)->hide([
                'phone_number',
                'email',
                'status',
                'country',
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

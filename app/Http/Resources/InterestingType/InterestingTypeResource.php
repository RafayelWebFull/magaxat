<?php

namespace App\Http\Resources\InterestingType;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

class InterestingTypeResource extends BaseResource
{
    public static function collection($resource)
    {
        return tap(new InterestingTypeCollection($resource), function ($collection) {
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
            'name' => $this->name,
            'created_at' => $this->created_at->format('d/m/Y H:m'),
            'updated_at' => $this->updated_at->format('d/m/Y H:m'),
        ]);
    }
}

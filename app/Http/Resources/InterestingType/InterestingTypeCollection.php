<?php

namespace App\Http\Resources\InterestingType;

use App\Http\Resources\BaseCollection;

class InterestingTypeCollection extends BaseCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->processCollection($request);
    }

    /**
     * Send fields to hide to Resource while processing the collection.
     *Processing collection of hidden fields through resource
     *
     * @param $request
     * @return array
     */
    protected function processCollection($request)
    {
        return $this->collection->map(function (InterestingTypeResource $resource) use ($request) {
            return $resource->hide($this->withoutFields)->toArray($request);
        })->all();
    }
}

<?php

namespace App\Http\Resources\Country;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

class CountryResource extends BaseResource
{
    public static function collection($resource)
    {
        return tap(new CountryCollection($resource), function ($collection) {
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
    }
}

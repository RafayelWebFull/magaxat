<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseCollection extends ResourceCollection
{
    /**
     * @var array
     */
    protected $withoutFields = [];

    public function hide(array $fields)
    {
        $this->withoutFields = $fields;
        return $this;
    }
}

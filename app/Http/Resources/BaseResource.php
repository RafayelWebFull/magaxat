<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    /**
     * @var array
     */
    protected $withoutFields = [];

    /**
     * @var array
     */
    protected $onlyFields = [];

    /**
     * Set the keys that are supposed to be filtered out.
     *
     * @param array $fields
     * @return $this
     */
    public function hide(array $fields): BaseResource
    {
        $this->withoutFields = $fields;
        return $this;
    }

    /**
     * Set the keys that are supposed to be filtered.
     *
     * @param array $fields
     * @return $this
     */
    public function only(array $fields): BaseResource
    {
        $this->onlyFields = $fields;
        return $this;
    }

    /**
     * Remove the filtered keys.
     *
     * @param $array
     * @return array
     */
    protected function filterFields($array): array
    {
        if(empty($this->onlyFields)){
            return collect($array)->forget($this->withoutFields)->toArray();
        }else{
            return collect($array)->only($this->onlyFields)->toArray();
        }
    }
}

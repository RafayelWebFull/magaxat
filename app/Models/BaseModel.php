<?php

namespace App\Models;

use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function scopeFilterUsing(Builder $query, ?AbstractFilter $filter, string $method = 'handle', ...$args) : Builder
    {
        return $filter ? $filter->{$method}($query,...$args) : $query;
    }
}

<?php


namespace App\Http\DataProviders;


use App\Http\Filters\PostFilter;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

class PostDataProvider
{
    private $filter;

    public function __construct(PostFilter $filter)
    {
        $this->filter = $filter;
    }

    public function getBuilder(): Builder
    {
        $query = Post::filterUsing($this->filter);

        return $query;
    }
}
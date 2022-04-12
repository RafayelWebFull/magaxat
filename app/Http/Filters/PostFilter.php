<?php

namespace App\Http\Filters;

class PostFilter extends AbstractFilter
{
    public function rules(): array
    {
        return [
            'q' => ['action' => 'search' , 'searchIn' => [
                'title'
            ]],
        ];
    }
}
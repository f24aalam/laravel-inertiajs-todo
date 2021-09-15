<?php

namespace App\GraphQL\Mutations;

use App\Models\Category;
use Illuminate\Support\Arr;

class CategoryMutator
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $category = new Category();
        $category->name = Arr::get($args, 'name');
        $category->save();

        return $category;
    }
}

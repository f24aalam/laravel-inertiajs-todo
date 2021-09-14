<?php

namespace App\GraphQL\Mutations;

use App\Models\Task;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class TaskMutator
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $task = new Task();
        $task->description = Arr::get($args, 'description');
        $task->category_id = Arr::get($args, 'category_id');
        $task->save();

        return $task;
    }
}

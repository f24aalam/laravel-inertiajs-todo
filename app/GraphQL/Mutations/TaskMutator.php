<?php

namespace App\GraphQL\Mutations;

use App\Models\Task;
use Illuminate\Support\Arr;

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

        return $task;
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveTaskRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Task;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = function () {
            return Category::where('team_id', Auth::user()->currentTeam->id)
                ->active()
                ->get();
        };

        $tasks = Task::with('category')
            ->activeCategory()
            ->with('category')
            ->where([
                'user_id' => Auth::user()->id,
                'team_id' => Auth::user()->currentTeam->id,
            ])
            ->get();

        return Inertia::render('Task/Index', [
            'categories' => $categories,
            'tasks' => $tasks,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveTaskRequest $request)
    {
        $task = new Task();
        $task->description = $request->description;
        $task->category_id = $request->category_id;
        $task->save();

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(SaveTaskRequest $request, Task $task)
    {
        $task->description = $request->description;
        $task->category_id = $request->category_id;
        $task->completed = $request->completed;
        $task->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

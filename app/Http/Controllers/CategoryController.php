<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveCategoryRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('team_id', Auth::user()->currentTeam->id)
            ->withCount('tasks')
            ->get();

        return Inertia::render('Category/Index', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->active = $request->active;
        $category->save();

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(SaveCategoryRequest $request, Category $category)
    {
        $category->name = $request->name;
        $category->active = $request->active;
        $category->save();

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\TaskCategory;
use App\Models\Task;

class CategoriesController extends Controller
{
    //
    public function index()
    {
        // Fetch all categories
        $categories = TaskCategory::with('tasks')->get();
        return view('Categories/Index', compact('categories'));
    }

    public function create()
    {
        // Fetch tasks for the form
        $tasks = Task::all();
        return view('Categories/Create', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'string|nullable',
            'task_ids' => 'array'
        ]);

        $category = new TaskCategory();
        $category->name = $request->name;
        $category->save();

        if ($request->task_ids) {
            $category->tasks()->attach($request->task_ids);
        }

        return redirect()->route('categories.index')->with('status', 'Category created successfully.');
    }

    public function edit(TaskCategory $category)
    {
        $tasks = Task::all();
        $categoryTasks = $category->tasks->pluck('id')->toArray();

        return view('Categories/Edit', compact('category', 'tasks', 'categoryTasks'));
    }

    public function update(Request $request, TaskCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'string|nullable',
            'task_ids' => 'array'
        ]);

        $category->update(['name' => $request->name]);

        if ($request->task_ids) {
            $category->tasks()->sync($request->task_ids);
        } else {
            $category->tasks()->detach();
        }

        return redirect()->route('categories.index')->with('status', 'Category updated successfully.');
    }

    public function destroy(TaskCategory $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('status', 'Category deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\TaskCategory;
use App\Models\Task;
use Illuminate\Support\Facades\Log;

class CategoriesController extends Controller
{
    //
    public function index()
    {
        // Fetch all categories
        $categories = TaskCategory::with('tasks')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        // Fetch tasks for the form
        $tasks = Task::all();
        return view('categories.create', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'string|nullable',
            'task_ids' => 'array|exists:tasks,id'
        ]);

        try {
            $category = new TaskCategory();
            $category->name = $request->name;
            $category->color = $request->color;
            $category->save();

            if ($request->task_ids) {
                $category->tasks()->attach($request->task_ids);
            }

            return redirect()->route('categories.index')->with('status', 'Category created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating category: ' . $e->getMessage());
            return redirect()->route('categories.index')->withErrors(['error' => 'There was an error creating the category.']);
        }
    }

    public function edit(TaskCategory $category)
    {
        $tasks = Task::all();
        $categoryTasks = $category->tasks->pluck('id')->toArray();

        return view('categories.edit', compact('category', 'tasks', 'categoryTasks'));
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

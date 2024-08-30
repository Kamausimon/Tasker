<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tasks = Task::all();
        Log::info("Fetched all the tasks");
        return view('task.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'completed_at' => 'nullable|date',
            'due_at' => 'nullable|date|after_or_equal:today',
            'priority' => 'required|string|in:low,medium,high',
            'project_id' => 'nullable|exists:projects,id',
            'category_id' => 'nullable|exists:task_categories,id'

        ]);
        try {


            $task = Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'completed' => false,
                'completed_at' => $request->completed_at,
                'due_at' => $request->due_at,
                'priority' => $request->priority,
                'project_id' => $request->project_id,
                'category_id' => $request->category_Id,
                'user_id' => Auth::id(),
            ]);
            Log::info('Task created successfully.', ['task_id' => $task->id]);
            return redirect()->route('task.index')->with('status', 'task created successfully');
        } catch (\Exception $e) {
            Log::error('Error creating task: ' . $e->getMessage());
            return redirect()->route('task.create')->with('error', 'There was an error creating the task.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $task = Task::findOrFail($id);
        return view('task.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $task = Task::findOrFail($id);
        if (!$task) abort(404);
        return view('task.edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'completed' => 'boolean',
            'completed_at' => 'timestamp|nullable',
            'due_at' => 'nullable|timestamp',
            'priority' => 'required|string|in:low,medium,high'
        ]);

        $task = Task::findOrFail($id);

        try {

            $task->update($validatedData);
            Log::info('task updated successfully');
            return redirect()->route('tasks.show', $task->id)->with('status', 'Task updated successfully');
        } catch (\Exception $e) {
            Log::error('There was an error creating the product' . $e->getMessage());
            return redirect()->route('tasks.show', $task->id)->with('status', 'error updating the product');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        try {

            $task->delete();
            Log::info('task deleted successfully');
            return redirect()->route('Task.index')->with('status', 'task deleted');
        } catch (\Exception $e) {
            Log::error('There was an error creating the product' . $e->getMessage());
            return redirect()->route('tasks.index', $task->id)->with('status', 'There was an error deleting the product');
        }
    }
}

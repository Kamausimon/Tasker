<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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

    public function showCase()
    {
        $tasks = Task::all();
        Log::info("Fetched all the tasks");
        return view('task.all', ['tasks' => $tasks]);
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
            return redirect()->route("task.show", $task->id)->with('status', 'task created successfully');
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
        // @dd($task->due_at, gettype($task->due_at));


        return view('task.edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([

                'category_id' => 'nullable|exists:task_categories,id',
                'project_id' => 'nullable|exists:projects,id',
            ]);

            // Proceed with updating the task or any other logic
            $task = Task::findOrFail($id);

            $task->completed = $request->has('completed');
            $task->completed_at = $request->input('completed_at');
            $task->due_at = $request->input('due_at');
            $task->priority = $request->input('priority');
            $task->description = $request->input('description');
            $task->title = $request->input('title');
            $task->user_id = Auth::id();
            $task->save();

            return redirect()->route('task.show', $task->id)->with('status', 'Task updated successfully');
        } catch (ValidationException $e) {
            // Log the validation errors
            Log::error('Validation failed', [
                'errors' => $e->errors(), // Logs all validation errors
                'input' => $request->all(), // Logs all input data for debugging
            ]);

            // Optionally, redirect back with the validation errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log any other exceptions
            Log::error('There was an error updating the task', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('task.show', $id)->with('status', 'Error updating the task');
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
            return redirect()->route('task.index')->with('status', 'task deleted');
        } catch (\Exception $e) {
            Log::error('There was an error creating the product' . $e->getMessage());
            return redirect()->route('task.index', $task->id)->with('status', 'There was an error deleting the product');
        }
    }
}

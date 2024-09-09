<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\facades\Log;
use App\Models\Task;
use App\Models\User;
use Illuminate\validation\ValidationException;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $projects = Project::with('collaborators')->get();

        return view('project.all', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to create a project.');
        }

        Log::info('cleared to create');
        $validated =  $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'task_ids' => 'nullable|array',
            'task_ids.*' => 'exists:tasks,id',
            'tasks' => 'nullable|array',
            'tasks.*.title' => 'required|string|max:255',
            'tasks.*.description' => 'nullable|string',
            'tasks.*.due_at' => 'nullable|date',
            'tasks.*.priority' => 'nullable|in:low,medium,high',
            'tasks.*.completed' => 'boolean',
            'tags' => 'nullable|string',
            'priority' => 'required|string|in:low,medium,high',

        ]);


        Log::info('all data validated');

        try {
            $project = Project::create([
                'name' => $request->name,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'user_id' => Auth::id(),
                'completed' => false,
                'task_ids' => $request->task_ids,
                'tasks' => $request->tasks,
                'tags' => $request->tags,
                'priority' => $request->priority,
                'owner_id' => Auth::id()

            ]);

            // Attach tasks to project if any were selected
            if ($request->has('task_ids')) {
                $project->tasks()->sync($request->task_ids);
            }

            if (isset($validated['tasks'])) {
                foreach ($validated['tasks'] as $taskData) {
                    $taskData['project_id'] = $project->id;
                    Task::create($taskData);
                }
            }

            Log::info('Project created successfully.', ['project_id' => $project->id]);

            return redirect()->route('project.show', $project->id)->with('status', 'Project created successfully!');
        } catch (\Exception $e) {
            Log::error('There was an error creating the project: ' . $e->getMessage());
            return redirect()->route('project.create')->with('error', 'There was an error creating the project.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $project = Project::with(['collaborators', 'tasks'])->findOrFail($id);

        return view('project.show', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $project = Project::findOrFail($id);
        if (!$project) abort(404);
        return view('Project.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

        try {
            // Validate the incoming data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'tasks' => 'nullable|array',
                'tasks.*.id' => 'nullable|exists:tasks,id', // Validate task IDs
                'tasks.*.title' => 'required|string|max:255',
                'tasks.*.description' => 'nullable|string',
                'tasks.*.due_at' => 'nullable|date',
                'tasks.*.priority' => 'nullable|in:low,medium,high',
                'tasks.*.completed' => 'boolean',
                'tags' => 'nullable|string',
                'priority' => 'nullable|string|in:low,medium,high',
                'completed' => 'boolean',
                'collaborators' => 'nullable|array',
                'collaborators.*' => 'email|exists:users,email',
            ]);

            // Update project with validated data
            $project->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'start_date' => $validatedData['start_date'],
                'end_date' => $validatedData['end_date'],
                'priority' => $validatedData['priority'] ?? $project->priority,
                'completed' => $validatedData['completed'] ?? $project->completed,
                'tags' => $validatedData['tags'] ?? $project->tags,
            ]);

            // Handle tasks if provided
            if (!empty($validatedData['tasks'])) {
                foreach ($validatedData['tasks'] as $taskData) {
                    if (isset($taskData['id'])) {
                        // Update existing task or create if not found
                        Task::updateOrCreate(
                            ['id' => $taskData['id'], 'project_id' => $project->id], // Condition to match
                            [
                                'title' => $taskData['title'],
                                'description' => $taskData['description'] ?? null,
                                'due_at' => $taskData['due_at'] ?? null,
                                'priority' => $taskData['priority'] ?? 'medium',
                                'completed' => $taskData['completed'] ?? false,
                                'user_id' => Auth::id(), // Ensure the task is assigned to the current user
                            ]
                        );
                    } else {
                        // Create a new task if no ID provided
                        $project->tasks()->create([
                            'title' => $taskData['title'],
                            'description' => $taskData['description'] ?? null,
                            'due_at' => $taskData['due_at'] ?? null,
                            'priority' => $taskData['priority'] ?? 'medium',
                            'completed' => $taskData['completed'] ?? false,
                            'user_id' => Auth::id(),
                        ]);
                    }
                }
            }

            // Handle collaborators
            if (!empty($validatedData['collaborators'])) {
                $userIds = User::whereIn('email', $validatedData['collaborators'])->pluck('id')->toArray();
                $project->collaborators()->sync($userIds); // Sync collaborators
            }

            return redirect()->route('project.show', $project->id)->with('status', 'Project updated successfully');
        } catch (ValidationException $e) {
            // Log validation errors
            Log::error('Validation failed', [
                'errors' => $e->errors(),
                'input' => $request->all(),
            ]);
            return redirect()->route('project.show', $project->id)
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating the project: ' . $e->getMessage());
            return redirect()->route('project.show', $project->id)->with('status', 'Error updating project details');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $project = Project::findOrFail($id);

        try {
            $project->delete();
            log::info('product deleted successfully');
            return redirect()->route('project.index')->with('status', 'success deleting product');
        } catch (\Exception $e) {
            log::error('There was an error deleting the project' . $e->getMessage());
            return redirect()->route('project.all')->with('status', 'Encountered error while deleting product');
        }
    }

    public function addCollaborators(Request $request, string $projectId)
    {
        $project = Project::findOrFail($projectId);

        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $user = User::findOrFail($request->user_id);
        $project->collaborators()->attach($user->id);

        return redirect()->route('projects.show', $projectId)->with('success', 'Collaborator added successfully.');
    }

    public function removeCollaborators(Request $request, string $projectId)
    {
        $project = Project::findOrFail($projectId);

        // Validate the incoming request to ensure the user ID exists
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Remove the user as a collaborator from the project
        $project->collaborators()->detach($request->user_id);

        return redirect()->route('projects.show', $projectId)->with('success', 'Collaborator removed successfully.');
    }
}

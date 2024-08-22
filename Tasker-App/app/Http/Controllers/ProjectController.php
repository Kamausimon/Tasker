<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\facades\Log;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $projects = Project::all();

        return view('project.index', ['projects' => $projects]);
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

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'date|required',
            'end_date' => 'date|required|after_or_equal:start_date',
            'task_ids' => 'nullable|array',
            'task_ids*' => 'exists:tasks,id'
        ]);

        $project =  Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'user_id' => Auth::id()
        ]);

        // Attach tasks to project if any were selected
        if ($request->has('task_ids')) {
            $project->tasks()->sync($request->task_ids);
        }

        return redirect()->route('project.index')->with('status', 'Project created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $project = Project::findOrFail($id);

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
        //
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'date|required',
            'end_date' => 'date|required|after_or_equal:start_date',
            'task_ids' => 'nullable|array',
            'task_ids*' => 'exists:tasks,id'
        ]);

        $project = Project::findOrFail($id);

        try {
            $project->update([$validatedData]);

            return redirect()->route('project.show', $project->id)->with('status', 'success updating the project details');
        } catch (\Exception $e) {
            log::error('there was an error updating the product' . $e->getMessage());
            return redirect()->route('project.show', $project->id)->with('status', 'error updating project details');
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
            return redirect()->route('project.index')->with('status', 'Encountered error while deleting product');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Tag;
use Illuminate\support\facades\Log;

class TagController extends Controller
{
    //
    public function create()
    {
        return view("tag.create");
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'string|nullable'
        ]);

        try {
            $tag = Tag::create($validatedData);

            if ($request->has('tasks')) {
                $tag->tasks()->attach($request->input('tasks'));
            }

            Log::info('Tag created successfully.', ['tag_id' => $tag->id]);

            return redirect()->route('task.index')->with('success', 'Tag created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating tag: ' . $e->getMessage());
            return redirect()->route('tag.create')->with('error', 'There was an error creating the tag.');
        }
    }

    public function edit(string $id)
    {
        $tag = Tag::findOrFail($id);

        return view('tag.edit', ['tag' => $tag]);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'string|nullable'
        ]);

        $tag = Tag::findOrFail($id);
        try {
            $tag->update($validatedData);

            if ($request->has('tasks')) {
                $tag->tasks()->sync($request->input('tasks'));
            }

            Log::info('Tag updated successfully.', ['tag_id' => $tag->id]);

            return redirect()->route('tags.index')->with('status', 'Tag updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating tag: ' . $e->getMessage());
            return redirect()->route('tags.index')->with('status', 'There was an error updating the tag.');
        }
    }

    public function destroy(string $id)
    {
        $tag = Tag::findOrFail($id);

        try {
            $tag->delete();

            Log::info('Tag deleted successfully.', ['tag_id' => $tag->id]);

            return redirect()->route('tasks.index')->with('status', 'Tag deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting tag: ' . $e->getMessage());
            return redirect()->route('tasks.index')->with('status', 'There was an error deleting the tag.');
        }
    }
}

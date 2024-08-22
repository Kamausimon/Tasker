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
            'name' => 'string|required|max:255',
            'color' => 'string|nullable'
        ]);

        $tag = Tag::create($validatedData);

        if ($request->has('tasks')) {
            $tag->tags()->Attach($request->input('tasks'));
        }

        return redirect()->route('tasks.index')->with('success', '');
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
                $tag->tags()->sync($request->input('tasks'));
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage() . 'there was an error while updating the tag');
            return redirect()->route('')->with('status', 'there was an error');
        }
    }

    public function destroy(string $id)
    {
        $tag = Tag::findorfail($id);

        try {

            $tag->delete();

            return redirect()->route('tasks.index')->with('status', 'success deleting tag');
        } catch (\Exception $e) {
            log::error('there was an error deleting the tag' . $e->getMessage());
            return redirect()->route('tasks.index')->with('status', 'error deleting tag');
        }
    }
}

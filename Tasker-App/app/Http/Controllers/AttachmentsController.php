<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;
use Inertia\Inertia;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class AttachmentsController extends Controller
{
    //index,store,download,destroy


    public function store(Request $request, string $id)
    {
        $request->validate([
            'file' => 'required|file|max:2048',
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('attachments', 'public');
        }

        $task = Task::findOrFail($id);

        try {
            $attachment = new Attachment([
                'task_id' => $task->id,
                'user_id' => Auth::id(),
                'file_path' => $path,
                'file_name' => $file->getClientOriginalName(),
                'file_type' => $file->getClientMimeType(),
                'file_size' => $file->getSize(),
            ]);

            $attachment->save();

            return redirect()->route('tasks.show', $task->id)->with('status', 'file saved up sucessfully');
        } catch (\Exception $e) {
            log::error('there was an error' . $e->getMessage());
            return redirect()->route('tasks.index')->with('status', 'there was an error saving the attachment');
        }
    }

    public function download(Attachment $attachment)
    {

        if (Auth::id() !== $attachment->user_id) {
            return redirect()->back()->withErrors(['error' => 'you dont have permission']);
        }
        return Storage::download($attachment->file_path, $attachment->file_name);
    }

    public function destroy(Attachment $attachment)
    {
        if (Auth::id() !== $attachment->user_id) {
            return redirect()->back()->withErrors(['error' => 'You do not have permission to delete this file.']);
        }

        // Delete the file from storage
        Storage::disk('public')->delete($attachment->file_path);

        // Delete the attachment record from the database
        $attachment->delete();

        return redirect()->back()->with('status', 'Attachment deleted successfully.');
    }
}

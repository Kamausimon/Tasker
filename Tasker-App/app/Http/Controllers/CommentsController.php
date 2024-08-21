<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use Illuminate\Support\Facades\Log;

class CommentsController extends Controller
{
    //
    public function index()
    {
        $comments = Comment::orderBy("created_at", "desc")->paginate(10);
        return view("Comments/index", compact("comments"));
    }

    public function store(Request $request, string $id)
    {
        $request->validate([
            'comment' => 'text|required',
        ]);
        $task = Task::findOrFail($id);
        Comment::create([
            'comment' => $request->comment,
            'user_id' => Auth::id(),
            'task_id' => $task->id,
        ]);

        return redirect()->route('tasks.show')->with('status', 'success the comment has been created');
    }

    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);


        try {
            $comment->delete();

            Log::info('comment deleted successfully');
            return redirect()->route('tasks.index')->with('status', 'comment deleted successfully');
        } catch (\Exception $e) {
            Log::error('there was an error deleting the comment');
            return redirect()->route('tasks.index')->with('status', 'error when deleting comment');
        }
    }
}

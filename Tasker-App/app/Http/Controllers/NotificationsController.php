<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class NotificationsController extends Controller
{
    // index, markaasread,sendnotification, destroy

    public function index()
    {
        $notifications = Auth::user()->notifications;

        return view('notification.index', ['notifications' => $notifications]);
    }

    public function markAsRead($id)
    {
        // Find the notification by id
        $notification = Auth::user()->notifications->findOrFail($id);
        $notification->markAsRead();

        return redirect()->back()->with('status', 'Notification marked as read.');
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return redirect()->back()->with('status', 'All notifications marked as read.');
    }

    /**
     * Delete a notification.
     */
    public function destroy($id)
    {
        // Find the notification by id
        $notification =  Auth::user()->notifications->findOrFail($id);
        $notification->delete();

        return redirect()->back()->with('status', 'Notification deleted.');
    }

    /**
     * Send a notification (example method).
     */
    public function sendNotification(Request $request, string $id)
    {

        $request->validate([
            'message' => 'required|string',
        ]);

        // Create a notification instance
        $notification = new Notification($request->message);

        $user = User::findOrFail($id);
        // Send notification to the user
        Notification::send($user, $notification);

        return redirect()->back()->with('status', 'Notification sent successfully.');
    }
}

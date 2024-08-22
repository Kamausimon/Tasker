<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class NotificationsController extends Controller
{
    // index, markaasread,sendnotification, destroy

    public function index()
    {
        $notifications = Auth::user()->notifications;
        Log::info('Fetched all notifications for user.', ['user_id' => Auth::id()]);
        return view('notification.index', ['notifications' => $notifications]);
    }

    public function markAsRead($id)
    {
        try {
            // Validate the ID
            $notification = Auth::user()->notification->findOrFail($id);
            $notification->markAsRead();
            Log::info('Notification marked as read.', ['notification_id' => $id]);

            return redirect()->back()->with('status', 'Notification marked as read.');
        } catch (\Exception $e) {
            Log::error('Error marking notification as read: ' . $e->getMessage(), ['notification_id' => $id]);
            return redirect()->back()->with('error', 'There was an error marking the notification as read.');
        }
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        try {
            Auth::user()->unreadNotifications->markAsRead();
            Log::info('All notifications marked as read.', ['user_id' => Auth::id()]);

            return redirect()->back()->with('status', 'All notifications marked as read.');
        } catch (\Exception $e) {
            Log::error('Error marking all notifications as read: ' . $e->getMessage());
            return redirect()->back()->with('error', 'There was an error marking all notifications as read.');
        }
    }

    /**
     * Delete a notification.
     */
    public function destroy($id)
    {
        try {
            // Validate the ID
            $notification = Auth::user()->notifications->findOrFail($id);
            $notification->delete();
            Log::info('Notification deleted.', ['notification_id' => $id]);

            return redirect()->back()->with('status', 'Notification deleted.');
        } catch (\Exception $e) {
            Log::error('Error deleting notification: ' . $e->getMessage(), ['notification_id' => $id]);
            return redirect()->back()->with('error', 'There was an error deleting the notification.');
        }
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

<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:notifications.view')->only(['index', 'markAsRead']);
        $this->middleware('can:notifications.delete')->only(['destroy']);
    }

    public function index()
    {
        $notifications = Auth::user()->notifications()->latest()->paginate(20);
        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead(Notification $notification)
    {
        if ($notification->utilisateur_id == Auth::id()) {
            $notification->update(['lu' => true]);
            return back()->with('success', 'Notification marquée comme lue.');
        }
        return back()->with('error', 'Action non autorisée.');
    }

    public function destroy(Notification $notification)
    {
        if ($notification->utilisateur_id == Auth::id()) {
            $notification->delete();
            return back()->with('success', 'Notification supprimée.');
        }
        return back()->with('error', 'Action non autorisée.');
    }
}

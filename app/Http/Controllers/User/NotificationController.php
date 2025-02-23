<?php

namespace App\Http\Controllers\User;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Support\Str;

class NotificationController extends Controller
{
    public function index()
    {
        return view('user.notifications.index');
    }

    public function fetchNotifications(Request $request)
    {
        if ($request->ajax()) {
            $data = Notification::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('notifications.show', $row->id) . '" class="btn btn-primary btn-sm">View</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function show($id)
    {
        $notification = Notification::findOrFail($id);
        return view('user.notifications.show', compact('notification'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        Notification::create([
            'user_id'   => auth()->id(),
            'title'     => $request->title,
            'reference' => Str::uuid(),
            'message'   => $request->message,
            'status'    => 'unread',
        ]);

        return back()->with('success', 'Notification created successfully.');
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['status' => 'read']);

        return back()->with('success', 'Notification marked as read.');
    }

    public function destroy($id)
    {
        Notification::findOrFail($id)->delete();
        return back()->with('success', 'Notification deleted.');
    }
}

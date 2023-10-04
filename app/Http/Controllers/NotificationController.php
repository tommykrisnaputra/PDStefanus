<?php

namespace App\Http\Controllers;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->unreadNotifications;
        return view('notification/index', compact('notifications'));
    }

    public function read($id)
    {
        auth()->user()
            ->unreadNotifications
            ->when($id, function ($query) use ($id) {
                return $query->where('id', $id);
            })
            ->markAsRead();

        return redirect()
            ->back();
    }

    public function readAll()
    {
        auth()->user()
            ->unreadNotifications
            ->markAsRead();

        return redirect()
            ->back();
    }
}
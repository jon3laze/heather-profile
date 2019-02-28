<?php

namespace App\Http\Controllers;

use App\User;

class UserNotificationController extends Controller
{
    public function destroy(User $user, $notificationId)
    {
        auth()->user()->notifications()->findOrFail($notificationId)->markAsRead();
    }

    public function index()
    {
        return auth()->user()->unreadNotifications;
    }
}

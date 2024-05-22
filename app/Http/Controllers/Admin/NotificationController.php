<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function destroy()
    {
        $notifications = DatabaseNotification::all();

        foreach ($notifications as $notification) {
            $notification->delete();
        }

        return redirect()->back();
    }
}

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


//        dd($notifications);

        foreach ($notifications as $notification) {
            $notification->delete();
        }

        return redirect()->back();
    }


    public function show(){

        $contacts = DatabaseNotification::all();

        return view('admin.notification.show', compact('contacts'));

    }


}

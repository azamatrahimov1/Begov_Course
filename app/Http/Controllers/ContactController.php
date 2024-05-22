<?php

namespace App\Http\Controllers;

use App\Events\MessageCreate;
use App\Models\About;
use App\Models\Contact;
use App\Models\Logo;
use App\Notifications\ContactCreated;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        $abouts = About::all();
        $logos = Logo::all();

        return view('contact', compact('contacts', 'abouts', 'logos'));
    }

    public function store(Request $request)
    {
        $message = $request->validate([
            'full_name' => 'required|string',
            'phone_number' => 'required|regex:/^(\+?998)?\d{9}$/|unique:contacts',
            'desc' => 'required',
        ]);

        $contact = Contact::create($message);

        $data = [
            'full_name' => $message['full_name'],
            'phone_number' => $message['phone_number'],
            'desc' => $message['desc'],
        ];

        event(new MessageCreate($data));

        $contact->notify(new ContactCreated($contact));

        return redirect()->back()->with('success', 'Sizning habaringiz muvaffaqiyatli yuborildi!');
    }
}

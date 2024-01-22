<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        $abouts = About::all();

        return view('contact', compact('contacts', 'abouts'));
    }

    public function store(Request $request)
    {
        Contact::create($request->all());

        return redirect()->route('contact.index')->with('success', 'Contact created successfully!');
    }
}

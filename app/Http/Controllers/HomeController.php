<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Chapter;
use App\Models\MainScreen;

class HomeController extends Controller
{
    public function index(Chapter $chapter)
    {
        $chapters = Chapter::where('parent_id', 0)->get();

        $mainScreens = MainScreen::all();
        $abouts = About::all();

        return view('index', compact('chapters', 'mainScreens', 'abouts'));
    }
}

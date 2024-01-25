<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Chapter;
use App\Models\MainScreen;
use App\Models\Offline;
use App\Models\Online;

class HomeController extends Controller
{
    public function index()
    {
//        $chapters = Chapter::where('parent_id', 0)->get();

        $mainScreens = MainScreen::all();
        $abouts = About::all();
        $onlines = Online::all();
        $offlines = Offline::all();

        return view('index', compact( 'mainScreens', 'abouts', 'onlines', 'offlines'));
    }
}

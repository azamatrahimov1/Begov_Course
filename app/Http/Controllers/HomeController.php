<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Gallery;
use App\Models\Logo;
use App\Models\MainScreen;
use App\Models\Offline;
use App\Models\Online;
use App\Models\Order;
use App\Models\Student;
use App\Models\Team;

class HomeController extends Controller
{
    public function index()
    {
        $mainScreens = MainScreen::all();
        $abouts = About::all();
        $onlines = Online::all();
        $oflines = Offline::all();
        $logos = Logo::all();
        $galleries = Gallery::all();
        $teams = Team::all();
        $students = Student::all();

        return view('index', compact( 'mainScreens', 'abouts', 'onlines', 'oflines', 'logos', 'galleries', 'teams', 'students'));
    }
}

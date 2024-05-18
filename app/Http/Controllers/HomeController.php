<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Logo;
use App\Models\MainScreen;
use App\Models\Offline;
use App\Models\Online;
use App\Models\Order;

class HomeController extends Controller
{
    public function index()
    {
        $mainScreens = MainScreen::all();
        $abouts = About::all();
        $onlines = Online::all();
        $oflines = Offline::all();
        $logos = Logo::all();

        return view('index', compact( 'mainScreens', 'abouts', 'onlines', 'oflines', 'logos'));
    }
}

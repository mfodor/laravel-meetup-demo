<?php

namespace App\Http\Controllers;

class LandingPageController extends Controller
{
    public function welcome() {
        return view('welcome');
    }

    public function dashboard() {
        return view('dashboard');
    }
}

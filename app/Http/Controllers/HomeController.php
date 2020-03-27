<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{    
    public function welcome()
    {
        $active = "welcome";
        return view('home/welcome', compact('active'));
    }
    
    public function introduction()
    {
        $active = "introduction";
        return view('home/introduction', compact('active'));
    }
    
    public function features()
    {
        $active = "features";
        return view('home/features', compact('active'));
    }
    
    public function contact()
    {
        $active = "contact";
        return view('home/contact', compact('active'));
    }
    
    public function thanks()
    {
        $active = "thanks";
        return view('home/thanks', compact('active'));
    }
}

<?php

namespace App\Http\Controllers;

class ViewController extends Controller
{
    public function viewHomePage()
    {
        return view('home');
    }

    public function viewLoginPage()
    {
        return view('auth.login');
    }

    public function viewRegisterPage()
    {
        return view('auth.register');
    }
}

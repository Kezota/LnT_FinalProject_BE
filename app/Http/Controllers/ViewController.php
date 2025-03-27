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

    public function viewCatalogPage()
    {
        return view('user.catalog');
    }

    public function viewCartPage()
    {
        return view('user.cart');
    }

    public function viewDashboardPage()
    {
        return view('admin.dashboard');
    }

    public function viewInsertProductPage()
    {
        return view('admin.insertProduct');
    }

    public function viewEditProductPage()
    {
        return view('admin.editProduct');
    }
}

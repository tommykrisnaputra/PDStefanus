<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    {
        return view('home');
    }

    public function success() 
    {
        return view('success');
    }

    public function login() 
    {
        return view('login');
    }
}

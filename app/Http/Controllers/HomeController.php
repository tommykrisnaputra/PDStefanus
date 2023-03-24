<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::where('active', '=', '1')->orderBy('order_number')->get();
        return view('home', ['events' => $events]);
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

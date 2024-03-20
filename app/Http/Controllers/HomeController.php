<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\TemaPd;

class HomeController extends Controller {
    public function index() {
        $temaPd = TemaPd::where('active', '=', '1')->orderByDesc('date')->get();
        $events = Event::where('active', '=', '1')->orderBy('order_number')->get();
        return view('home', ['events' => $events, 'temaPd' => $temaPd]);
        }

    public function success() {
        return view('success');
        }

    public function login() {
        return view('login');
        }
    }

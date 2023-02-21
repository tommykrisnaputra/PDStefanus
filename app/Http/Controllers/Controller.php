<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}

class UserController extends Controller
{
    /**
     * Show the profile for a given user.
     */
    public function show(): View
    {
        $users = DB::table('users')->get();
        return view('users', ['users' => $users]);
        // return view('users', [
        //     'user' => User::findOrFail($id)
        // ]);
    }
}
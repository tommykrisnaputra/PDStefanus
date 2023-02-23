<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class RegisterController extends Controller
{
    /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.register');
    }

    /**
     * Handle account registration request
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request) 
    {
        $request->validate([
            // 'fullname' => 'required|unique:users|max:255',
            'email' => 'required',
            'phone_number' => 'required|numeric',
            'birthdate' => 'nullable|date',
        ]);

        // info($request);
        // return $request;
        // return redirect()->back()->withErrors(['fullname' => $request]);
        return redirect()->back()->with(['message' => 'Data  berhasil  di update']);
        // $user = User::create($request->validated());

        // auth()->login($user);

        // return redirect('/')->with('success', "Account successfully registered.");
    }
}

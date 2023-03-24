<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|numeric|unique:users',
            'birthdate' => 'required|date',
            'social_instagram' => 'nullable|regex:/^^(?!.*\.\.)(?!.*\.$)[^\W][\w.]{0,29}$/',
            'social_tiktok' => 'nullable|regex:/^^(?!.*\.\.)(?!.*\.$)[^\W][\w.]{0,29}$/',
            'paroki' => 'nullable|regex:/^[a-zA-Z0-9\s]+$/',
            'address' => 'nullable|regex:/^[a-zA-Z0-9\s]+$/',
            'gender' => 'required|in:male,female',
            'first_attendance' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        } else {
            $user = User::create($request->all());
            if (Auth::check()) {
                return redirect('/users');
            } else {
                auth()->login($user);
                return redirect()->route('success');
            }
        }
    }
}

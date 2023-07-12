<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handle account login request
     *
     * @param LoginRequest $request
     *
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if (!$request->checkCredentials($credentials)) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['email' => 'Data user tidak ditemukan.']);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return redirect()
            ->back()
            ->withInput()
            ->withErrors(['password' => 'Password yang anda masukan salah.']);
    }

    /**
     * Handle response after user authenticated
     *
     * @param Request $request
     * @param Auth $user
     *
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect('/');
    }
}

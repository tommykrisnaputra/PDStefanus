<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
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
            'phone' => 'required|numeric|unique:users',
            'birthdate' => 'required|date',
            'social_instagram' => 'nullable|regex:/^^(?!.*\.\.)(?!.*\.$)[^\W][\w.]{0,29}$/',
            'social_tiktok' => 'nullable|regex:/^^(?!.*\.\.)(?!.*\.$)[^\W][\w.]{0,29}$/',
            'paroki' => 'nullable|regex:/^[a-zA-Z0-9\s]+$/',
            'address' => 'nullable',
            'wilayah' => 'nullable|regex:/^[a-zA-Z0-9\s]+$/',
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
            $user = User::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'birthdate' => $request->birthdate,
                'social_instagram' => $request->social_instagram,
                'social_tiktok' => $request->social_tiktok,
                'address' => $request->address,
                'wilayah' => $request->wilayah,
                'paroki' => $request->paroki,
                'gender' => $request->gender,
                'first_attendance' => $request->first_attendance,
                'last_attendance' => $request->first_attendance,
                'password' => $request->password,
                'total_attendance' => '1',
                'attendance_percentage' => '100',
                'description' => '',
                'created_by' => Auth::id(),
            ]);
            
            $attendance = Attendance::create([
                'user_id' => $user->id,
                'event_id' => 4, // PD Kamis
                'description' => 'Pendaftaran',
                'created_by' => Auth::id() ?? $user->id,
                'date' => $request->first_attendance,
            ]);

            if (Auth::check() && Auth::User()->isAdmin()) {
                return redirect('/users');
            } else {
                auth()->login($user);
                $request->session()->regenerate();
                return redirect()->route('success');
            }
        }
    }
}

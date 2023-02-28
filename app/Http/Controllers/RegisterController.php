<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use DB;

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
            'fullname' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|numeric|unique:users',
            'birthdate' => 'required|date',
            'social_instagram' => 'nullable|regex:/^^(?!.*\.\.)(?!.*\.$)[^\W][\w.]{0,29}$/',
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
            $user = DB::table('users')->insertGetId([
                'full_name' => $request->fullname,
                'birthdate' => $request->birthdate,
                'address' => $request->address,
                'paroki' => $request->paroki,
                'phone_number' => $request->phone_number,
                'social_instagram' => $request->social_instagram,
                'email' => $request->email,
                'gender' => $request->gender,
                'first_attendance' => $request->first_attendance,
                'last_attendance' => $request->first_attendance,
                'total_attendance' => 1,
                'attendance_percentage' => 100,
                'active' => 'true',
            ]);
            DB::table('password')->insert([
                'user_id' => $user,
                'password' => $request->password,
                'active' => 'true',
            ]);
            return redirect('/success');
            // return redirect()
            //     ->back()
            //     ->with(['message' => 'Data  berhasil  di update']);
        }
    }
}

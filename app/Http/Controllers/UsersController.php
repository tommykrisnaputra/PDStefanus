<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\HelperController as helper;
use Illuminate\Support\Facades\Validator;
use Exception;
use DB;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $helper = new helper();
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    public function add()
    {
        $users = User::all();
        return view('users.edit', ['users' => $users]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
            'birthdate' => 'required|date',
            'address' => 'nullable|regex:/^[a-zA-Z0-9\s]+$/',
            'paroki' => 'nullable|regex:/^[a-zA-Z0-9\s]+$/',
            'gender' => 'required|in:male,female',
            'first_attendance' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        } else {
            User::find($request->id)->update([
                'full_name' => $request->full_name,
                'birthdate' => $request->birthdate,
                'address' => $request->address,
                'paroki' => $request->paroki,
                'social_instagram' => $request->social_instagram,
                'social_tiktok' => $request->social_tiktok,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'gender' => $request->gender,
                'first_attendance' => $request->first_attendance,
                'last_attendance' => $request->last_attendance,
                'total_attendance' => $request->total_attendance,
                'attendance_percentage' => $request->attendance_percentage,
                'description' => $request->description,
            ]);
            return redirect('/users')->with(['message' => 'Data ' . $request->full_name . ' berhasil  di update']);
        }
    }

    public function search(Request $request)
    {
        try {
            if ($request->keyword) {
                $users = DB::table('users')
                    ->where('full_name', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhere('paroki', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhere('phone_number', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhere('address', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhere('social_instagram', 'LIKE', '%' . $request->keyword . '%')
                    ->get();
            } else {
                $users = User::all();
            }
            return response()->json([
                'users' => $users,
            ]);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}

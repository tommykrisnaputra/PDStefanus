<?php

namespace App\Http\Controllers;

use Exception;
use DB;
use App\Models\User;
use App\Models\Role;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\HelperController as helper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    public function edit($id)
    {
        $helper = new helper();
        $users = User::find($id);
        $roles = Role::find($users->role_id);
        $users->phone = $helper->checkPhone($users->phone);
        return view('users.form', ['users' => $users, 'roles' => $roles]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|max:255',
            'role' => 'required|numeric',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'birthdate' => 'required|date',
            'address' => 'nullable|regex:/^[a-zA-Z0-9\s\.]+$/',
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
                'role_id' => $request->role,
                'birthdate' => $request->birthdate,
                'address' => $request->address,
                'paroki' => $request->paroki,
                'social_instagram' => $request->social_instagram,
                'social_tiktok' => $request->social_tiktok,
                'phone' => $request->phone,
                'email' => $request->email,
                'gender' => $request->gender,
                'first_attendance' => $request->first_attendance,
                'last_attendance' => $request->last_attendance,
                'total_attendance' => $request->total_attendance,
                'attendance_percentage' => $request->attendance_percentage,
                'description' => $request->description,
                'updated_by' => Auth::id(),
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
                    ->orWhere('phone', 'LIKE', '%' . $request->keyword . '%')
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

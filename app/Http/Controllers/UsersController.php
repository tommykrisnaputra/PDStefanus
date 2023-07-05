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
use App\Http\Requests\LoginRequest;
use Carbon\Carbon;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $request['operators'] = ['=', '>=', '<='];
        $request['roles'] = [null => 'Pilih Role','1' => 'Umat', '2' => 'Admin'];
        $request['days'] = range(0, 31);
        $request['months'] = [null, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $query = User::orderByDesc('users.created_at');

        if ($request->filled('full_name')) {
            $query->where('users.full_name', 'like', '%' . $request['full_name'] . '%');
        }
        if ($request->filled('phone')) {
            $query->where('users.phone', 'like', '%' . $request['phone'] . '%');
        }
        if ($request->filled('email')) {
            $query->where('users.email', 'like', '%' . $request['email'] . '%');
        }
        if ($request->filled('role')) {
            $query->where('users.role_id', $request['role']);
        }
        if ($request->filled('paroki')) {
            $query->where('users.paroki', 'like', '%' . $request['paroki'] . '%');
        }
        if ($request->filled('wilayah')) {
            $query->where('users.wilayah', 'like', '%' . $request['wilayah'] . '%');
        }
        if ($request->filled('address')) {
            $query->where('users.address', 'like', '%' . $request['address'] . '%');
        }
        if ($request->filled('total_attendance')) {
            $query->where('users.total_attendance', $request['total_op'], $request['total_attendance']);
        }
        if ($request->filled('attendance_percentage')) {
            $query->where('users.attendance_percentage', $request['percentage_op'], $request['attendance_percentage']);
        }
        if ($request->filled('birthdate')) {
            $query->whereDate('users.birthdate', '=', $request['birthdate']);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('users.last_attendance', '>=', $request['date_from']);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('users.last_attendance', '<=', $request['date_to']);
        }
        if ($request->filled('fa_from')) {
            $query->whereDate('users.first_attendance', '>=', $request['fa_from']);
        }
        if ($request->filled('fa_to')) {
            $query->whereDate('users.first_attendance', '<=', $request['fa_to']);
        }

        $day_from = $request['day_from'] > 0 ? $request['day_from'] : 1;
        $month_from = $request->filled('month_from') ? date("n",strtotime($request['month_from'])) : 1;
        $day_to = $request['day_to'] > 0 ? $request['day_to'] : 31;
        $month_to = $request->filled('month_to') ? date("n",strtotime($request['month_to'])) : 12;
        $query->birthdayBetween($day_from, $day_to, $month_from, $month_to);

        $results = $query->get();

        // $data['attendance'] = $users->paginate(15)->withQueryString();
        return view('users.index', ['users' => $results, 'data' => $request]);
    }

    public function edit($id)
    {
        $helper = new helper();
        $users = User::find($id);
        $roles = Role::find($users->role_id);
        $users->phone = $helper->checkPhone($users->phone);
        return view('users.form', ['users' => $users, 'roles' => $roles]);
    }

    public function selfedit()
    {
        $helper = new helper();
        $users = User::find(Auth::id());
        $roles = Role::find($users->role_id);
        $users->phone = $helper->checkPhone($users->phone);
        return view('users.form', ['users' => $users, 'roles' => $roles]);
    }

    public function changepassword()
    {
        return view('auth.changepassword');
    }

    public function updatepassword(LoginRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        } else {
            $credentials = $request->getCredentials();
            // dd ($credentials);

            $user_id = $request->checkCredentials($credentials);
            // dd ($user_id);

            if (!$user_id) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['email' => 'Data user tidak ditemukan.']);
            }

            User::find($user_id)->update([
                'password' => $credentials['password'],
                'updated_by' => Auth::id(),
            ]);

            return redirect()->route('success');
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|max:255',
            'role' => 'numeric',
            'email' => 'email',
            'phone' => 'required|numeric',
            'birthdate' => 'required|date',
            'address' => 'nullable',
            'wilayah' => 'nullable|regex:/^[a-zA-Z0-9\s\.]+$/',
            'paroki' => 'nullable|regex:/^[a-zA-Z0-9\s]+$/',
            'gender' => 'in:male,female',
            // 'first_attendance' => 'required',
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
                'wilayah' => $request->wilayah,
                'paroki' => $request->paroki,
                'social_instagram' => $request->social_instagram,
                'social_tiktok' => $request->social_tiktok,
                'phone' => $request->phone,
                'email' => $request->email,
                'gender' => $request->gender,
                // 'first_attendance' => $request->first_attendance,
                'last_attendance' => $request->last_attendance,
                // 'total_attendance' => $request->total_attendance,
                // 'attendance_percentage' => $request->attendance_percentage,
                // 'description' => $request->description,
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
                    ->orWhere('wilayah', 'LIKE', '%' . $request->keyword . '%')
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

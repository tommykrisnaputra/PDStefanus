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
use App\Http\Requests\LoginRequest;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller {
    public function index(Request $request) {
        $request['operators'] = ['=', '>=', '<='];
        $request['roles']     = [NULL => 'Pilih Role', '1' => 'Umat', '2' => 'Admin', '3' => 'Tim'];
        $request['days']      = range(0, 31);
        $request['months']    = [NULL, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $query = User::orderByDesc('users.created_at');

        $query->when($request->filled('full_name'), function ($q) use ($request) {
            return $q->where('users.full_name', 'like', '%' . $request['full_name'] . '%');
            })
            ->when($request->filled('phone'), function ($q) use ($request) {
                return $q->where('users.phone', 'like', '%' . $request['phone'] . '%');
                })
            ->when($request->filled('email'), function ($q) use ($request) {
                return $q->where('users.email', 'like', '%' . $request['email'] . '%');
                })
            ->when($request->filled('role'), function ($q) use ($request) {
                return $q->where('users.role_id', $request['role']);
                })
            ->when($request->filled('paroki'), function ($q) use ($request) {
                return $q->where('users.paroki', 'like', '%' . $request['paroki'] . '%');
                })
            ->when($request->filled('wilayah'), function ($q) use ($request) {
                return $q->where('users.wilayah', 'like', '%' . $request['wilayah'] . '%');
                })
            ->when($request->filled('address'), function ($q) use ($request) {
                return $q->where('users.address', 'like', '%' . $request['address'] . '%');
                })
            ->when($request->filled('total_attendance'), function ($q) use ($request) {
                return $q->where('users.total_attendance', $request['total_op'], $request['total_attendance']);
                })
            ->when($request->filled('attendance_percentage'), function ($q) use ($request) {
                return $q->where('users.attendance_percentage', $request['percentage_op'], $request['attendance_percentage']);
                })
            ->when($request->filled('birthdate'), function ($q) use ($request) {
                return $q->whereDate('users.birthdate', '=', $request['birthdate']);
                })
            ->when($request->filled('date_from'), function ($q) use ($request) {
                return $q->whereDate('users.last_attendance', '>=', $request['date_from']);
                })
            ->when($request->filled('date_to'), function ($q) use ($request) {
                return $q->whereDate('users.last_attendance', '<=', $request['date_to']);
                })
            ->when($request->filled('fa_from'), function ($q) use ($request) {
                return $q->whereDate('users.first_attendance', '>=', $request['fa_from']);
                })
            ->when($request->filled('fa_to'), function ($q) use ($request) {
                return $q->whereDate('users.first_attendance', '<=', $request['fa_to']);
                });

        $startMonth = $request->filled('month_from') ? date("n", strtotime($request['month_from'])) : 1;
        $startDay   = $request['day_from'] > 0 ? $request['day_from'] : 1;
        $endMonth   = $request->filled('month_to') ? date("n", strtotime($request['month_to'])) : 12;
        $endDay     = $request['day_to'] > 0 ? $request['day_to'] : 31;

        $query->whereRaw("MONTH(users.birthdate) BETWEEN ? AND ? AND DAY(users.birthdate) BETWEEN ? AND ?", [
            $startMonth, $endMonth, $startDay, $endDay
        ]);

        $results = $query->paginate(10)->withQueryString();

        return view('users.index', ['users' => $results, 'data' => $request]);
        }

    public function edit($id) {
        $helper = new helper();
        $users  = User::find($id);
        $role   = $users->role_id;
        if ($role == NULL) {
            User::find($users->id)->update([
                'role_id'    => 1,
                'updated_by' => Auth::id(),
            ]);
            $role = 1;
            }
        $roles        = Role::find($role);
        $users->phone = $helper->checkPhone($users->phone);
        return view('users.form', compact('users', 'roles'));
        }

    public function selfedit() {
        $helper = new helper();
        $users  = User::find(Auth::id());
        $role   = $users->role_id;
        if ($role == NULL) {
            User::find($users->id)->update([
                'role_id'    => 1,
                'updated_by' => Auth::id(),
            ]);
            $role = 1;
            }
        
        $roles        = Role::find($role);
        $users->phone = $helper->checkPhone($users->phone);
        return view('users.form', ['users' => $users, 'roles' => $roles]);
        }

    public function changepassword() {
        return view('auth.changepassword');
        }

    public function updatepassword(LoginRequest $request) {
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

            $user_id = $request->checkCredentials($credentials);

            if (! $user_id) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['email' => 'Data user tidak ditemukan.']);
                }

            User::find($user_id)->update([
                'password'   => $credentials['password'],
                'updated_by' => Auth::id(),
            ]);

            return redirect()->route('success');
            }
        }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|max:255',
            'role'      => 'numeric',
            'email'     => 'email|nullable',
            'phone'     => 'required|numeric',
            'birthdate' => 'required|date',
            'address'   => 'nullable',
            'wilayah'   => 'nullable|regex:/^[a-zA-Z0-9\s\.]+$/',
            'paroki'    => 'nullable|regex:/^[a-zA-Z0-9\s]+$/',
            'gender'    => 'in:male,female',
            // 'first_attendance' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
            } else {
            User::find($request->id)->update([
                'full_name'        => $request->full_name,
                'role_id'          => $request->role ?? 1,
                'birthdate'        => $request->birthdate,
                'address'          => $request->address,
                'wilayah'          => $request->wilayah,
                'paroki'           => $request->paroki,
                'social_instagram' => $request->social_instagram,
                'social_tiktok'    => $request->social_tiktok,
                'phone'            => $request->phone,
                'email'            => $request->email,
                'gender'           => $request->gender,
                // 'first_attendance' => $request->first_attendance,
                'last_attendance'  => $request->last_attendance,
                // 'total_attendance' => $request->total_attendance,
                // 'attendance_percentage' => $request->attendance_percentage,
                // 'description' => $request->description,
                'updated_by'       => Auth::id(),
            ]);
            return redirect('/users')->with(['message' => 'Data ' . $request->full_name . ' berhasil  di update']);
            }
        }

    public function search(Request $request) {
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

    public function export(Request $request) {
        $export = new UsersExport($request);
        return Excel::download($export, 'Data Umat ' . date('d-M-Y') . '.xlsx');
        }
    }

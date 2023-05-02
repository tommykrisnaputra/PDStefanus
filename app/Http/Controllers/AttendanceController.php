<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Requests\AttendanceRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTime;

class AttendanceController extends Controller
{
    public function show()
    {
        return view('attendance.register');
    }

    public function index(Request $request)
    {
        $query = Attendance::select('attendance.*', 'events.title', 'users.full_name', 'users.email', 'users.phone', 'users.paroki', 'users.address', 'users.wilayah', 'users.first_attendance', 'users.last_attendance', 'users.total_attendance', 'users.attendance_percentage')
            ->orderByDesc('date')
            ->join('users', 'users.id', '=', 'attendance.user_id')
            ->join('events', 'events.id', '=', 'attendance.event_id');

        if ($request->filled('full_name')) {
            $query->where('users.full_name', 'like', '%' . $request['full_name'] . '%');
        }
        if ($request->filled('email')) {
            $query->where('users.email', 'like', '%' . $request['email'] . '%');
        }
        if ($request->filled('phone')) {
            $query->where('users.phone', 'like', '%' . $request['phone'] . '%');
        }
        if ($request->filled('paroki')) {
            $query->where('users.paroki', 'like', '%' . $request['paroki'] . '%');
        }
        if ($request->filled('address')) {
            $query->where('users.address', 'like', '%' . $request['address'] . '%');
        }
        if ($request->filled('wilayah')) {
            $query->where('users.wilayah', 'like', '%' . $request['wilayah'] . '%');
        }
        if ($request->filled('date_from')) {
            $query->whereDate('attendance.date', '>=', $request['date_from']);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('attendance.date', '<=', $request['date_to']);
        }
        if ($request->filled('fa_from')) {
            $query->whereDate('users.first_attendance', '>=', $request['fa_from']);
        }
        if ($request->filled('fa_to')) {
            $query->whereDate('users.first_attendance', '<=', $request['fa_to']);
        }

        $results = $query->get();

        // $data['attendance'] = $query->paginate(15)->withQueryString();
        return view('attendance.index', ['attendance' => $results, 'data' => $request]);
    }

    public function register(AttendanceRequest $request)
    {
        $credentials = $request->getCredentials();
        $user_id = $request->checkCredentials($credentials);

        if (!$user_id) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['email' => 'Data user tidak ditemukan.']);
        }

        $user = User::find($user_id);
        $date = Carbon::today()->toDateString();

        $this->insertAttendance($user, $date);
        $this->countAttendance($user, $date);

        return redirect()->route('success');
    }

    public function insertAttendance($param, $date)
    {
        $attendance = Attendance::where('attendance.user_id', $param->id)
            ->where('attendance.event_id', '4')
            ->where('active', true)
            ->whereDate('date', $date)
            ->count();

        if ($attendance == 0) {
            $attendance = Attendance::create([
                'user_id' => $param->id,
                'event_id' => 4, // PD Kamis
                'date' => $date,
                'description' => 'Manual Attendance',
                'created_by' => Auth::id() ?? $param->id,
            ]);
        }
    }

    public function countAttendance($param, $date)
    {
        $total = $param->first_attendance->diffInWeeks(Carbon::parse($date)) + 1;

        $active = Attendance::where('attendance.user_id', $param->id)
            ->where('attendance.event_id', '4')
            ->where('active', true)
            ->count();

        $percentage = ($active / $total) * 100;

        User::find($param->id)->update([
            'last_attendance' => $date,
            'total_attendance' => $active,
            'attendance_percentage' => $percentage,
            'updated_by' => Auth::id(),
        ]);
    }
}

// $to = \Carbon\Carbon::parse($request->to);
// $from = \Carbon\Carbon::parse($request->from);

// $years = $to->diffInYears($from);
// $months = $to->diffInMonths($from);
// $weeks = $to->diffInWeeks($from);
// $days = $to->diffInDays($from);
// $hours = $to->diffInHours($from);
// $minutes = $to->diffInMinutes($from);
// $seconds = $to->diffInSeconds($from);

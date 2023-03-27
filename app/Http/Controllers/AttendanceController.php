<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Requests\AttendanceRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function show()
    {
        return view('auth.attendance');
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
        // dd ($user_id);

        $user = User::find($user_id);

        $this->insertAttendance($user);

        $this->countAttendance($user);

        return redirect()->route('success');
    }

    public function insertAttendance($param)
    {
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::where('attendance.user_id', $param->id)
            ->where('attendance.event_id', '4')
            ->where('active', true)
            ->whereDate('date', $today)
            ->count();
        // dd($attendance);

        if ($attendance == 0) {
            $attendance = Attendance::create([
                'user_id' => $param->id,
                'event_id' => 4, // PD Kamis
                'description' => 'Pendaftaran',
                'created_by' => Auth::id() ?? $param->id,
            ]);
        }
    }

    public function countAttendance($param)
    {
        $today = Carbon::today()->toDateString();
        
        $total = Carbon::today()->diffInWeeks($param->first_attendance) + 1;
        // dd($total);

        $active = Attendance::where('attendance.user_id', $param->id)
            ->where('attendance.event_id', '4')
            ->where('active', true)
            ->count();
        // dd($active);

        $percentage = ($active / $total) * 100;
        // dd($percentage);

        User::find($param->id)->update([
            'last_attendance' => $today,
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

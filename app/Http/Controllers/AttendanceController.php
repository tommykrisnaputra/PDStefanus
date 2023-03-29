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
        return view('attendance.register');
    }

    public function index(Request $request)
    {
        // return view('attendance.index');

        $data['keyword'] = $request->query('keyword');
        $data['category_id'] = $request->query('category_id');
        $data['start'] = $request->query('start');
        $data['end'] = $request->query('end');
        // $data['categories'] = Category::all();
        $data['operators'] = [
            '=' => 'equal to',
            '<>' => 'not equal to',
            '>' => 'greater than',
            '>=' => 'greater than or equal to',
            '<' => 'less than',
            '<=' => 'less than or equal to',
            'between' => 'between',
        ];
        $data['total_operator'] = $request->get('total_operator');
        $data['total_value'] = $request->get('total_value');
        $data['total_value_end'] = $request->get('total_value_end');

        $query = Attendance::select('attendance.*', 'events.title', 'users.full_name', 'users.first_attendance')
            ->orderByDesc('date')
            ->join('users', 'users.id', '=', 'attendance.user_id')
            ->join('events', 'events.id', '=', 'attendance.event_id')
            ->where(function ($query) use ($data) {
                $query->where('full_name', 'like', '%' . $data['keyword'] . '%');
                // $query->orWhere('customer_name', 'like', '%' . $data['keyword'] . '%');
                // $query->orWhere('category_name', 'like', '%' . $data['keyword'] . '%');
            });

        if ($data['start']) {
            $query->whereDate('order_date', '>=', $data['start']);
        }
        if ($data['end']) {
            $query->whereDate('order_date', '<=', $data['end']);
        }
        if ($data['category_id']) {
            $query->where('categories.category_id', $data['category_id']);
        }
        if ($data['total_operator']) {
            if ($data['total_operator'] == 'between') {
                $query->whereRaw('quantity * price between ? AND ?', [$data['total_value'], $data['total_value_end']]);
            } else {
                $query->whereRaw('quantity * price ' . $data['total_operator'] . ' ? ', $data['total_value']);
            }
        }

        // dd ($query);
        $results = $query->get();

        // $data['attendance'] = $query->paginate(15)->withQueryString();
        return view('attendance.index', ['attendance' => $results]);
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

        $date = Carbon::createFromFormat('Y-m-d', $request->date);

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
        $total = $date->diffInWeeks($param->first_attendance) + 1;

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

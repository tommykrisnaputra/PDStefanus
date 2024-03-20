<?php

namespace App\Http\Controllers;

use App\Models\TeamEvents;
use App\Models\TeamAttendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamAttendanceController extends Controller {
    public function index($id) {
        $events = TeamEvents::find($id);

        $count_attendance = TeamAttendance::where('team_event_id', $id)->count();
        $count_team       = User::whereIn('role_id', [2, 3])->where('users.id', '<>', '1')->count();

        if ($count_team != $count_attendance) {
            $total_team = User::whereIn('role_id', [2, 3])->where('users.id', '<>', '1')->get();
            foreach ($total_team as $team) {
                $check = TeamAttendance::where('team_event_id', $id)->where('user_id', $team->id)->first();

                if (is_null($check)) {
                    TeamAttendance::insert(['user_id' => $team->id, 'team_event_id' => $id, 'date' => $events->date, 'description' => NULL, 'active' => FALSE, 'created_by' => 1]);
                    }
                }
            }

        $present    = TeamAttendance::where('team_event_id', $id)->where('active', '1')->count();
        $absent     = TeamAttendance::where('team_event_id', $id)->where('active', '0')->count();
        $attendance = TeamAttendance::where('team_event_id', $id)->join('users', 'users.id', 'team_attendances.user_id')->select('team_attendances.*', 'users.full_name as name')->orderBy('name', 'asc')->get();

        return view('team-attendance.form', ['events' => $events, 'attendance' => $attendance, 'present' => $present, 'absent' => $absent]);
        }

    public function update(Request $request) {
        $attendance             = TeamAttendance::findOrFail($request->id);
        $attendance->active     = ! $attendance->active;
        $events_id              = $attendance->team_event_id;
        $attendance->date       = now();
        $attendance->updated_by = Auth::id();
        $attendance->save();

        return redirect('/team-attendance/' . $events_id);
        }
    }

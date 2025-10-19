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

    public function bulkUpdate(Request $request) {
        // Validate that at least one checkbox is selected
        $request->validate([
            'attendance_ids' => 'required|array',
        ], [
            'attendance_ids.required' => 'Pilih minimal satu peserta untuk diperbarui.',
        ]);

        $attendanceIds = $request->attendance_ids;
        $updatedCount  = 0;

        foreach ($attendanceIds as $id) {
            $attendance = TeamAttendance::find($id);

            if ($attendance) {
                if ($attendance->active == 0) {
                    // Mark as attended
                    $attendance->active = 1;
                    $attendance->date   = now();
                    } else {
                    // Revert attendance (unset)
                    $attendance->active = 0;
                    $attendance->date   = NULL;
                    }

                $attendance->updated_by = Auth::id();
                $attendance->save();
                $updatedCount++;
                }
            }

        return redirect()->back()->with('success', "Berhasil {$updatedCount} absensi.");
        }


    public function updateDescription(Request $request, $id) {
        $attendance              = TeamAttendance::findOrFail($request->id);
        $attendance->active      = $request->input('status');
        $events_id               = $attendance->team_event_id;
        $attendance->description = $request->input('description');
        $attendance->date        = now();
        $attendance->updated_by  = Auth::id();
        $attendance->save();

        return redirect('/team-attendance/' . $events_id);
        // return redirect()->back()->with( 'success', 'Absensi berhasil diperbarui.' );
        }
    }

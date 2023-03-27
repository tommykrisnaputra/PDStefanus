<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AttendanceRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Event;
use App\Models\Attendance;

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

        $attendance = Attendance::where('attendance.user_id', $user_id)
            ->where('attendance.event_id', '4')
            ->join('events', 'events.id', '=', 'attendance.event_id')
            ->get();

        // "id" => 4
        // "user_id" => 3
        // "event_id" => 4
        // "description" => "PD Stefanus di adakan setiap hari kamis malam pukul 19.00 WIB"
        // "active" => 1
        // "created_at" => "2023-03-27 17:23:18"
        // "created_by" => null
        // "updated_at" => "2023-03-27 17:23:18"
        // "updated_by" => null
        // "title" => "PD Stefanus"
        // "date" => "2023-03-30 00:00:00"
        // "media" => "https://www.imb.org/wp-content/uploads/2016/08/Local-Church.jpg"
        // "links" => "https://pdstefanusgrogol.com/"
        // "address" => null
        // "order_number" => 4

        dd($attendance);

        // $event = Event::find($attendance->event_id)->get();


        $attendance = Attendance::create([
            'user_id' => $user->id,
            'event_id' => 4, // PD Kamis
            'description' => 'Pendaftaran',
            'created_by' => Auth::id() ?? $user->id,
        ]);

        User::find($user_id)->update([
            'password' => $credentials['password'],
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('success');
    }
}

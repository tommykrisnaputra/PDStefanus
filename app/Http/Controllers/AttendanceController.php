<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Requests\AttendanceRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller {
    public function show() {
        return view('attendance.register');
        }

    public function index(Request $request) {
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
            } elseif (Carbon::today() == Carbon::parse('this Thursday')) {
            $query->whereDate('attendance.date', '>=', Carbon::parse('this Thursday'));
            } else {
            $query->whereDate('attendance.date', '>=', Carbon::parse('last Thursday'));
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

        $results = $query->paginate(10)->withQueryString();

        if ($request->action == 'download') {
            $data_array[] = array("Nama", "Phone", "Paroki", "Alamat", "Wilayah", "First Attendance", "Last Attendance", "Total Attendance", "Attendance Percentage", "Deskripsi");

            foreach ($results as $data_item) {
                $data_array[] = array(
                    'Nama'                  => $data_item->full_name,
                    'Phone'                 => $data_item->phone,
                    'Paroki'                => $data_item->paroki,
                    'Alamat'                => $data_item->address,
                    'Wilayah'               => $data_item->wilayah,
                    'First Attendance'      => $data_item->first_attendance,
                    'Last Attendance'       => $data_item->created_at,
                    'Total Attendance'      => $data_item->total_attendance,
                    'Attendance Percentage' => $data_item->attendance_percentage,
                    'Deskripsi'             => $data_item->description
                );
                }

            $this->ExportExcel($data_array);
            } else {
            // dd($results);
            // $data['attendance'] = $query->paginate(15)->withQueryString();
            return view('attendance.index', ['attendance' => $results, 'data' => $request]);
            }
        }

    public function register(AttendanceRequest $request) {
        $credentials = $request->getCredentials();
        $user_id     = $request->checkCredentials($credentials);

        if (! $user_id) {
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

    public function insertAttendance($param, $date) {
        $attendance = Attendance::where('attendance.user_id', $param->id)
            ->where('attendance.event_id', '4')
            ->where('active', TRUE)
            ->whereDate('date', $date)
            ->count();

        if ($attendance == 0) {
            $attendance = Attendance::create([
                'user_id'     => $param->id,
                'event_id'    => 4,
                // PD Kamis
                'date'        => $date,
                'description' => 'Manual Attendance',
                'created_by'  => Auth::id() ?? $param->id,
            ]);
            }
        }

    public function countAttendance($param, $date) {
        $total = $param->first_attendance->diffInWeeks(Carbon::parse($date)) + 1;

        $active = Attendance::where('attendance.user_id', $param->id)
            ->where('attendance.event_id', '4')
            ->where('active', TRUE)
            ->count();

        $percentage = ($active / $total) * 100;

        User::find($param->id)->update([
            'last_attendance'       => $date,
            'total_attendance'      => $active,
            'attendance_percentage' => $percentage,
            'updated_by'            => Auth::id(),
        ]);
        }

    public function ExportExcel($attendance_data) {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($attendance_data);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Attendance_Data.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
            } catch (Exception $e) {
            return;
            }
        }

    public function export(Request $request) {
        $export = new AttendanceExport($request);
        return Excel::download($export, 'Data Kehadiran ' . date('d-M-Y') . '.xlsx');
        }
    }
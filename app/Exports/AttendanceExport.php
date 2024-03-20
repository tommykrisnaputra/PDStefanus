<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AttendanceExport implements FromCollection, WithHeadings, ShouldAutoSize {
    protected $requestdata;

    public function __construct($requestdata) {
        $this->requestdata = $requestdata;
        }
    public function headings(): array {
        return [
            "Nama Umat",
            "Wilayah",
            "Nomor HP",
            "Tanggal Kehadiran",
            "Pertama Datang",
            "Terakhir Datang",
            "Persentase Kehadiran",
            "Total Kehadiran",
            "Deskripsi"
        ];
        }

    public function collection() {
        $data = $this->requestdata;

        $query = Attendance::select('users.full_name', 'users.phone', 'users.wilayah', 'attendance.date as tanggal', 'users.first_attendance', 'users.last_attendance', 'users.attendance_percentage', 'users.total_attendance', 'attendance.description')
            ->when($data->full_name, function ($query) use ($data) {
                return $query->where('users.full_name', 'like', '%' . $data->full_name . '%');
                })
            ->when($data->phone, function ($query) use ($data) {
                return $query->where('users.phone', 'like', '%' . $data->phone . '%');
                })
            ->when($data->wilayah, function ($query) use ($data) {
                return $query->where('users.wilayah', 'like', '%' . $data->wilayah . '%');
                })
            ->when($data->fa_from, function ($query) use ($data) {
                return $query->whereDate('users.first_attendance', '>=', $data->fa_from);
                })
            ->when($data->fa_to, function ($query) use ($data) {
                return $query->whereDate('users.first_attendance', '<=', $data->fa_to);
                })
            ->when($data->date_from, function ($query) use ($data) {
                return $query->whereDate('attendance.date', '>=', $data->date_from);
                })
            ->when($data->date_to, function ($query) use ($data) {
                return $query->whereDate('attendance.date', '<=', $data->date_to);
                })
            ->orderByDesc('tanggal')
            ->join('users', 'users.id', '=', 'attendance.user_id')
            ->join('events', 'events.id', '=', 'attendance.event_id')
            ->get();

        foreach ($query as $dataset) {
            $dataset->tanggal          = date('d-M-Y', strtotime($dataset->tanggal));
            $dataset->first_attendance = date('d-M-Y', strtotime($dataset->first_attendance));
            $dataset->last_attendance  = date('d-M-Y', strtotime($dataset->last_attendance));
            }

        return $query;
        }
    }
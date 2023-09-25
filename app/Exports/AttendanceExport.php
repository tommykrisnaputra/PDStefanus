<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AttendanceExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $requestdata;

    public function __construct($requestdata)
    {
        $this->requestdata = $requestdata;
    }
    public function headings(): array
    {
        return [
            "Nama Umat",
            "Nomor HP",
            "wilayah",
            "Tanggal Kehadiran",
            "Pertama Datang",
            "Terakhir Datang",
            "Persentase Kehadiran",
            "Total Kehadiran",
            "Deskripsi"
        ];
    }

    public function collection()
    {
        $data = $this->requestdata;

        $query = Attendance::select('users.full_name', 'users.phone', 'users.wilayah', 'attendance.date as tanggal', 'users.first_attendance', 'users.last_attendance', 'users.attendance_percentage', 'users.total_attendance', 'attendance.description')
            ->orderByDesc('tanggal')
            ->join('users', 'users.id', '=', 'attendance.user_id')
            ->join('events', 'events.id', '=', 'attendance.event_id');

        if ($data->full_name) {
            $query->where('users.full_name', 'like', '%' . $data->full_name . '%');
        }
        if ($data->phone) {
            $query->where('users.phone', 'like', '%' . $data->phone . '%');
        }
        if ($data->wilayah) {
            $query->where('users.wilayah', 'like', '%' . $data->wilayah . '%');
        }
        if ($data->date_from) {
            $query->whereDate('attendance.date', '>=', $data->date_from);
        }
        if ($data->date_to) {
            $query->whereDate('attendance.date', '<=', $data->date_to);
        }
        if ($data->fa_from) {
            $query->whereDate('users.first_attendance', '>=', $data->fa_from);
        }
        if ($data->fa_to) {
            $query->whereDate('users.first_attendance', '<=', $data->fa_to);
        }

        $results = $query->get();

        foreach ($results as $dataset) {
            $dataset->tanggal = date('d-M-Y', strtotime($dataset->tanggal));
            $dataset->first_attendance = date('d-M-Y', strtotime($dataset->first_attendance));
            $dataset->last_attendance = date('d-M-Y', strtotime($dataset->last_attendance));
        }

        return $results;
    }
}
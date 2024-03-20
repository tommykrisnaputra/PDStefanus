<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromArray, WithHeadings, ShouldAutoSize {
    protected $requestdata;

    public function __construct($requestdata) {
        $this->requestdata = $requestdata;
        }
    public function headings(): array {
        return [
            "Nama Umat",
            "Tanggal Lahir",
            "Wilayah",
            "Nomor HP",
            "Terakhir Datang",
            "Persentase Kehadiran",
            "Total Kehadiran",
            "Deskripsi"
        ];
        }

    public function array(): array {
        $userQuery = [];
        $data      = $this->requestdata;

        $query = User::select('users.full_name', 'users.phone', 'users.email', 'users.role_id', 'users.paroki', 'users.wilayah', 'users.address', 'users.last_attendance', 'users.attendance_percentage', 'users.total_attendance', 'users.description', 'users.birthdate', 'users.first_attendance')
            ->when($data->full_name, function ($query) use ($data) {
                return $query->where('users.full_name', 'like', '%' . $data->full_name . '%');
                })
            ->when($data->phone, function ($query) use ($data) {
                return $query->where('users.phone', 'like', '%' . $data->phone . '%');
                })
            ->when($data->email, function ($query) use ($data) {
                return $query->where('users.email', 'like', '%' . $data->email . '%');
                })
            ->when($data->role, function ($query) use ($data) {
                return $query->where('users.role_id', $data->role);
                })
            ->when($data->paroki, function ($query) use ($data) {
                return $query->where('users.paroki', 'like', '%' . $data->paroki . '%');
                })
            ->when($data->wilayah, function ($query) use ($data) {
                return $query->where('users.wilayah', 'like', '%' . $data->wilayah . '%');
                })
            ->when($data->address, function ($query) use ($data) {
                return $query->where('users.address', 'like', '%' . $data->address . '%');
                })
            ->when($data->total_attendance, function ($query) use ($data) {
                return $query->where('users.total_attendance', $data->total_op, $data->total_attendance);
                })
            ->when($data->attendance_percentage, function ($query) use ($data) {
                return $query->where('users.attendance_percentage', $data->percentage_op, $data->attendance_percentage);
                })
            ->when($data->birthdate, function ($query) use ($data) {
                return $query->whereDate('users.birthdate', '=', $data->birthdate);
                })
            ->when($data->date_from, function ($query) use ($data) {
                return $query->whereDate('users.last_attendance', '>=', $data->date_from);
                })
            ->when($data->date_to, function ($query) use ($data) {
                return $query->whereDate('users.last_attendance', '<=', $data->date_to);
                })
            ->when($data->fa_from, function ($query) use ($data) {
                return $query->whereDate('users.first_attendance', '>=', $data->fa_from);
                })
            ->when($data->fa_to, function ($query) use ($data) {
                return $query->whereDate('users.first_attendance', '<=', $data->fa_to);
                })
            ->where(function ($query) use ($data) {
                $day_from   = $data->day_from > 0 ? $data->day_from : 1;
                $month_from = $data->month_from ? date("n", strtotime($data->month_from)) : 1;
                $day_to   = $data->day_to > 0 ? $data->day_to : 31;
                $month_to = $data->month_to ? date("n", strtotime($data->month_to)) : 12;
                return $query->birthdayBetween($day_from, $day_to, $month_from, $month_to);
                })
            ->orderByDesc('users.created_at')
            ->get();

        foreach ($query as $dataset) {
            $userQuery[] = collect([
                [
                    'nama'                  => $dataset->full_name,
                    'tanggal_lahir'         => date('d-M-Y', strtotime($dataset->birthdate)),
                    'wilayah'               => $dataset->wilayah,
                    'phone'                 => $dataset->phone,
                    'last_attendance'       => date('d-M-Y', strtotime($dataset->last_attendance)),
                    'attendance_percentage' => $dataset->attendance_percentage,
                    'total_attendance'      => $dataset->total_attendance,
                    'description'           => $dataset->description,
                ]
            ]);
            }

        return $userQuery;
        }
    }
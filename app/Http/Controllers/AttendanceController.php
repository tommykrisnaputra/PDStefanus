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
        return view('attendance.index');

        // $data['q'] = $request->query('q');
        // $data['category_id'] = $request->query('category_id');
        // $data['start'] = $request->query('start');
        // $data['end'] = $request->query('end');
        // $data['categories'] = Category::all();
        // $data['operators'] = [
        //     '=' => 'equal to',
        //     '<>' => 'not equal to',
        //     '>' => 'greater than',
        //     '>=' => 'greater than or equal to',
        //     '<' => 'less than',
        //     '<=' => 'less than or equal to',
        //     'between' => 'between',
        // ];
        // $data['total_operator'] = $request->get('total_operator');
        // $data['total_value'] = $request->get('total_value');
        // $data['total_value_end'] = $request->get('total_value_end');

        // $query = OrderDetail::select('order_details.*', 'orders.*', 'customers.*', 'categories.*', 'products.*')
        //     ->join('products', 'products.product_id', '=', 'order_details.product_id')
        //     ->join('orders', 'orders.order_id', '=', 'order_details.order_id')
        //     ->join('customers', 'customers.customer_id', '=', 'orders.customer_id')
        //     ->join('categories', 'categories.category_id', '=', 'products.category_id')
        //     ->where(function ($query) use ($data) {
        //         $query->where('product_name', 'like', '%' . $data['q'] . '%');
        //         $query->orWhere('customer_name', 'like', '%' . $data['q'] . '%');
        //         $query->orWhere('category_name', 'like', '%' . $data['q'] . '%');
        //     });

        // if ($data['start']) {
        //     $query->whereDate('order_date', '>=', $data['start']);
        // }
        // if ($data['end']) {
        //     $query->whereDate('order_date', '<=', $data['end']);
        // }
        // if ($data['category_id']) {
        //     $query->where('categories.category_id', $data['category_id']);
        // }
        // if ($data['total_operator']) {
        //     if ($data['total_operator'] == 'between') {
        //         $query->whereRaw('quantity * price between ? AND ?', [$data['total_value'], $data['total_value_end']]);
        //     } else {
        //         $query->whereRaw('quantity * price ' . $data['total_operator'] . ' ? ', $data['total_value']);
        //     }
        // }

        // $data['order_details'] = $query->paginate(15)->withQueryString();
        // return view('order_detail.index', $data);
    }

    // TABLE1::join('table2' , function($join){
    //     $join->on('table1.id', '=', 'table2.cat_id');
    //  })->select(['table2.cat_id' , 'table1.*'])
    //  ->where('table2.brand_id' , '=' , '2')
    //  ->groupBy('table2.cat_id');

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
                'description' => 'Absensi Manual',
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

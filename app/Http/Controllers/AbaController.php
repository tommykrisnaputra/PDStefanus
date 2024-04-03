<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aba;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AbaController extends Controller {
    public function index(Request $request) {
        $query = Aba::join('users', 'users.id', 'aba.user_id')
            ->select('aba.*', 'users.full_name as name', 'users.last_aba')
            ->orderBy('users.last_aba', 'desc')
            ->when($request->filled('date_from'), function ($q) use ($request) {
                return $q->whereDate('aba.date', '>=', $request['date_from']);
                }, function ($q) {
                    return $q->whereDate('aba.date', '>=', Carbon::now());
                    })
            ->when($request->filled('date_to'), function ($q) use ($request) {
                return $q->whereDate('aba.date', '<=', $request['date_to']);
                }, function ($q) {
                    return $q->whereDate('aba.date', '<=', Carbon::now());
                    })
            ->when($request->filled('full_name'), function ($q) use ($request) {
                return $q->where('users.full_name', 'like', '%' . $request['full_name'] . '%');
                });

        $results = $query->paginate(10)->withQueryString();

        return view('aba.index', ['aba' => $results, 'data' => $request]);
        }

    public function add() {
        return view('aba.add');
        }

    public function forgot() {
        $users = User::whereIn('role_id', [2, 3])
            ->where('users.id', '<>', '1')
            ->whereDate('users.last_aba', '<', date('Y-m-d'))
            ->paginate(10)->withQueryString();

        return view('aba.forgot', compact('users'));
        }

    public function edit($id) {
        $aba = Aba::join('users', 'users.id', 'aba.user_id')->select('aba.*', 'users.full_name as name')->find($id);
        return view('aba.form', ['aba' => $aba]);
        }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'date'        => 'nullable|date',
            'verses'      => 'nullable',
            'description' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
            } else {

            Aba::firstOrCreate([
                'verses'      => $request->verses,
                'date'        => $request->date,
                'description' => $request->description,
                'created_by'  => Auth::id(),
                'user_id'     => Auth::id(),
            ]);

            User::find(Auth::id())->update([
                'last_aba' => now(),
            ]);

            return redirect()->route('aba.show');
            }
        }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'date'        => 'nullable|date',
            'verses'      => 'nullable',
            'description' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
            } else {

            $aba = Aba::find($request->id);

            $aba_user = $aba->user_id;

            $aba->update([
                'verses'      => $request->verses,
                'date'        => $request->date,
                'description' => $request->description,
                'updated_by'  => Auth::id(),
            ]);

            User::find($aba_user)->update([
                'last_aba' => $request->date,
            ]);

            return redirect()->route('aba.show');
            }
        }

    public function delete($id) {
        Aba::find($id)->delete();
        return redirect()->route('aba.show');
        }
    }

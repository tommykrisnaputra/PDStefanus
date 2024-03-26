<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aba;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AbaController extends Controller {
    public function index() {
        $aba = Aba::join('users', 'users.id', 'aba.user_id')->select('aba.*', 'users.full_name as name')->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        return view('aba.index', ['aba' => $aba]);
        }

    public function add() {
        return view('aba.add');
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

            Aba::find($request->id)->update([
                'verses'      => $request->verses,
                'date'        => $request->date,
                'description' => $request->description,
                'updated_by'  => Auth::id(),
            ]);

            return redirect()->route('aba.show');
            }
        }


    public function delete($id) {
        Aba::find($id)->delete();
        return redirect()->route('aba.show');
        }
    }

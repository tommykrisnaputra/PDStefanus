<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aba;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AbaController extends Controller {
    public function index() {
        $aba = Aba::orderBy('order_number')->paginate(10)->withQueryString();
        return view('aba.index', ['aba' => $aba]);
        }

    public function add() {
        return view('aba.add');
        }

    public function edit($id) {
        $aba = Aba::find($id);
        return view('aba.form', ['aba' => $aba]);
        }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'verses'      => 'nullable',
            'date'        => 'nullable|date',
            'description' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
            } else {

            $events = TeamEvents::firstOrCreate([
                'verses'      => $request->title,
                'date'        => $request->date,
                'description' => $request->description,
                'created_by'  => Auth::id(),
            ]);

            return redirect()->route('team-events.show');
            }
        }
    }

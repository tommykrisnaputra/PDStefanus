<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\TemaPd;
use Illuminate\Support\Facades\Log;

class TemaPDController extends Controller
{
    public function index()
    {
        $TemaPd = TemaPd::orderByDesc('date')->get();
        return view('TemaPd.index', ['TemaPd' => $TemaPd]);
    }

    public function add()
    {
        return view('temapd.add');
    }

    public function edit($id)
    {
        $TemaPd = TemaPd::find($id);
        return view('temapd.form', ['TemaPd' => $TemaPd]);
    }

    public function create(Request $request)
    {
        Log::info('message ' . $request->title);
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'date' => 'nullable|date',
            'media' => 'nullable|url',
            'links' => 'nullable|url',
            'description' => 'nullable|regex:/^[a-zA-Z0-9\s\.]+$/',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        } else {
            TemaPd::create([
                'title' => $request->title,
                'date' => $request->date,
                'media' => $request->media,
                'links' => $request->links,
                'description' => $request->description,
            ]);
            return redirect()->route('temapd.show');
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'date' => 'nullable|date',
            'media' => 'nullable|url',
            'links' => 'nullable|url',
            'order_number' => 'nullable|numeric',
            'active' => 'nullable',
            'description' => 'nullable|regex:/^[a-zA-Z0-9\s\.]+$/',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        } else {
            TemaPd::find($request->id)->update([
                'title' => $request->title,
                'date' => $request->date,
                'media' => $request->media,
                'links' => $request->links,
                'active' => $request->active,
                'description' => $request->description,
                'updated_by' => Auth::id(),
            ]);
            return redirect('/temapd')->with(['message' => 'Data ' . $request->title . ' berhasil  di update']);
        }
    }

    public function search(Request $request)
    {
        try {
            if ($request->keyword) {
                $TemaPd = DB::table('tema_pd')
                    ->where('title', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhere('order_number', 'LIKE', '%' . $request->keyword . '%')
                    ->get();
            } else {
                $TemaPd = TemaPd::orderByDesc('date')->get();
            }
            return response()->json([
                'TemaPd' => $TemaPd,
            ]);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;

class EventsController extends Controller {
    public function index() {
        $events = Event::orderBy('order_number')->paginate(10)->withQueryString();
        return view('events.index', ['events' => $events]);
        }

    public function add() {
        return view('events.add');
        }

    public function edit($id) {
        $events = Event::find($id);
        return view('events.form', ['events' => $events]);
        }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'title'        => 'required|max:255',
            'date'         => 'nullable|date',
            'media'        => 'nullable|url',
            'links'        => 'nullable|url',
            'description'  => 'nullable',
            'order_number' => 'nullable|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
            } else {
            $events = Event::firstOrCreate([
                'title'        => $request->title,
                'date'         => $request->date,
                'media'        => $request->media,
                'links'        => $request->links,
                'order_number' => intval($request->order_number),
                'description'  => $request->description,
                'created_by'   => Auth::id(),
            ]);
            return redirect()->route('events.show');
            }
        }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'title'        => 'required|max:255',
            'date'         => 'nullable|date',
            'media'        => 'nullable|url',
            'links'        => 'nullable|url',
            'order_number' => 'nullable|numeric',
            'active'       => 'nullable',
            'description'  => 'nullable',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
            } else {
            Event::find($request->id)->update([
                'title'        => $request->title,
                'date'         => $request->date,
                'media'        => $request->media,
                'links'        => $request->links,
                'order_number' => intval($request->order_number),
                'active'       => $request->active,
                'description'  => $request->description,
                'updated_by'   => Auth::id(),
            ]);
            return redirect('/events')->with(['message' => 'Data ' . $request->title . ' berhasil  di update']);
            }
        }

    public function search(Request $request) {
        try {
            if ($request->keyword) {
                $events = DB::table('events')
                    ->where('title', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->keyword . '%')
                    ->get();
                } else {
                $events = Event::orderBy('order_number')->get();
                }
            return response()->json([
                'events' => $events,
            ]);
            } catch (Exception $e) {
            dd($e->getMessage());
            }
        }
    }

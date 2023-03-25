<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EventsController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('order_number')->get();
        return view('events.index', ['events' => $events]);
    }

    public function edit($id)
    {
        $events = Event::find($id);
        return view('events.form', ['events' => $events]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'date' => 'nullable|date',
            'media' => 'nullable|url',
            'links' => 'required|url',
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
            Event::find($request->id)->update([
                'title' => $request->title,
                'date' => $request->date,
                'media' => $request->media,
                'links' => $request->links,
                'order_number' => intval($request->order_number),
                'active' => $request->active,
                'description' => $request->description,
                'updated_by' => Auth::id(),
            ]);
            return redirect('/events')->with(['message' => 'Data ' . $request->title . ' berhasil  di update']);
        }
    }

    public function search(Request $request)
    {
        try {
            if ($request->keyword) {
                $users = DB::table('events')
                    ->where('title', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhere('order_number', 'LIKE', '%' . $request->keyword . '%')
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

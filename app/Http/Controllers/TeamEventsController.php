<?php

namespace App\Http\Controllers;

use App\Models\TeamAttendance;
use App\Models\TeamEvents;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TeamEventsController extends Controller
    {
    public function index ()
        {
        $events = TeamEvents::orderBy ( 'created_at', 'desc' )->paginate ( 10 )->withQueryString ();
        return view ( 'team-events.index', [ 'events' => $events ] );
        }

    public function add ()
        {
        return view ( 'team-events.add' );
        }

    public function edit ( $id )
        {
        $events = TeamEvents::find ( $id );
        return view ( 'team-events.form', [ 'events' => $events ] );
        }

    public function create ( Request $request )
        {
        $validator = Validator::make ( $request->all (), [ 
            'title'       => 'required|max:255',
            'date'        => 'nullable|date',
            'description' => 'nullable',
        ] );
        if ( $validator->fails () )
            {
            return redirect ()
                ->back ()
                ->withInput ()
                ->withErrors ( $validator );
            } else
            {
            $events = TeamEvents::firstOrCreate ( [ 
                'title'       => $request->title,
                'date'        => $request->date,
                'description' => $request->description,
                'created_by'  => Auth::id (),
            ] );

            $tim = User::whereIn ( 'role_id', [ 2, 3 ] )->where ( 'users.id', '<>', '1' )->get ();
            foreach ( $tim as $team )
                {
                $data[] = array(
                    'user_id'       => $team->id,
                    'team_event_id' => $events->id,
                    'date'          => $events->date,
                    'description'   => NULL,
                    'active'        => FALSE,
                    'created_by'    => '1'
                );
                }

            TeamAttendance::insert ( $data );

            return redirect ()->route ( 'team-events.show' );
            }
        }

    public function update ( Request $request )
        {
        $validator = Validator::make ( $request->all (), [ 
            'title'       => 'required|max:255',
            'date'        => 'nullable|date',
            'active'      => 'nullable',
            'description' => 'nullable',
        ] );
        if ( $validator->fails () )
            {
            return redirect ()
                ->back ()
                ->withInput ()
                ->withErrors ( $validator );
            } else
            {
            TeamEvents::find ( $request->id )->update ( [ 
                'title'       => $request->title,
                'date'        => $request->date,
                'active'      => $request->active,
                'description' => $request->description,
                'updated_by'  => Auth::id (),
            ] );
            return redirect ( '/team-events' )->with ( [ 'message' => 'Data ' . $request->title . ' berhasil  di update' ] );
            }
        }
    }

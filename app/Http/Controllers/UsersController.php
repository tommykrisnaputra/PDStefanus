<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\HelperController as helper;
use DB;

class UsersController extends Controller
{
    
    public function index() {
        $helper = new helper();
        $users = DB::table('users')->get();
        foreach($users as $check){
            $check->phone_number = $helper->checkPhone($check->phone_number);
        }
        return view('users.index', ['users' => $users]);
    }

    public function add(){
        $users = DB::table('users')->get();
        return view('users.edit', ['users' => $users]);
    }

    public function edit($id){
        $helper = new helper();
        $users = DB::table('users')->find($id);
        $users->phone_number = $helper->checkPhone($users->phone_number);
        return view('users.edit', ['users' => $users]);
    }

    public function create(Request $request){
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();
        // return redirect('add-blog-post-form')->with('status', 'Blog Post Form Data Has Been inserted');
    }

    public function update(Request $request){
        // $request->validate([
        //     'stock_name'=>'required',
        //     'ticket'=>'required',
        //     'value'=>'required|max:10|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/'
        // ]); 
        DB::beginTransaction();
        DB::table('users')
        ->where('id', $request->id)
        ->update([
            'full_name' => $request->fullname,
            'birthdate' => $request->birthdate,
            'address' => $request->address,
            'paroki' => $request->paroki,
            'social_instagram' => $request->social_instagram,
            'social_tiktok' => $request->social_tiktok,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'gender' => $request->gender,
            'first_attendance' => $request->first_attendance,
            'last_attendance' => $request->last_attendance,
            'total_attendance' => $request->total_attendance,
            'attendance_percentage' => $request->attendance_percentage,
            'description' => $request->description,
        ]);
        DB::commit();
        return redirect('/users')->with(['message' => 'User ' . $request->fullname . ' berhasil  di update']);
    }
}
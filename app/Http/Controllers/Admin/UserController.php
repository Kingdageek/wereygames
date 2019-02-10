<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UserController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {
        $users = User::all();
        return view('admin.user.index', [
            'users' => $users
        ]);
    }

    public function create(Request $request)
    {
        if($request->isMethod('POST')){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->input());
            }

            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'remember_token' => str_random(10),
            ]);

            return redirect()->route('admin.users')->with('success', 'Admin user created successfully');
        }
        return view('admin.user.create');
    }

    public function edit(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        if($request->isMethod('POST')){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'. $user->id,
                'password' => 'required|string|min:6',
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->input());
            }

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->save();

            return redirect()->route('admin.users')->with('success', 'Admin user created updated');
        }
        return view('admin.user.edit', [
            'user' => $user
        ]);
    }

    public function delete(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Admin user created deleted');
    }

}

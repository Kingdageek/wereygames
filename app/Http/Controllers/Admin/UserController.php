<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    
    public function __construct()
    {
        
    }

    public function index() 
    {
        $users = User::all();

        return view('admin.users.index', [
            'users' => $users
        ]);
    }

}

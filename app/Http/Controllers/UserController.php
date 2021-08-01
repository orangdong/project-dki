<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index(){
        $user = Auth::user();
        return view('user.dashboard', [
            'user' => $user,
            'title' => 'Dashboard'
        ]);
    }

    public function edit(){
        $user = Auth::user();
        return view('user-profile', [
            'user' => $user,
            'title' => 'Edit Profile'
        ]);
    }
}

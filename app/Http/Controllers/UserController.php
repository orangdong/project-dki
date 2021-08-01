<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $user = Auth::user();
        if($user->role == "admin"){
            return redirect(route('dashboard/form'));
        }
    }

    public function index(){
        
        return view('user.dashboard', [
            'user' => $user,
            'title' => 'Dashboard'
        ]);
    }
}

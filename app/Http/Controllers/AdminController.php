<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('admin.dashboard', [
            'user' => $user,
            'title' => 'Dashboard'
        ]);
    }

    public function export(){
        $user = Auth::user();
        return view('admin.export', [
            'user' => $user,
            'title' => 'Export'
        ]);
    }

    public function user(){
        $user = Auth::user();
        return view('admin.user', [
            'user' => $user,
            'title' => 'User Management'
        ]);
    }

    public function staff_code(){
        $user = Auth::user();
        return view('admin.staffcode', [
            'user' => $user,
            'title' => 'Staff Code'
        ]);
    }

    public function buat_form(){
        $user = Auth::user();
        return view('admin.buat-form', [
            'user' => $user,
            'title' => 'Buat Form'
        ]);
    }
}

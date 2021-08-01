<?php

namespace App\Http\Controllers;

use App\Models\StaffCode;
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
        $staffcode = StaffCode::first()->staff_code;
        return view('admin.staffcode', [
            'user' => $user,
            'title' => 'Staff Code',
            'staffcode' => $staffcode
        ]);
    }

    public function edit_code(Request $request){
        $code = $request->input('code');
        $code_confirmation = $request->input('code_confirmation');
        $current_code = StaffCode::first()->staff_code;

        if($code != $code_confirmation){
            return redirect(route('dashboard.staff-code').'?error=1&message=Kode%20konfirmasi%20tidak%20sesuai');
        }

        if($code == $current_code){
            return redirect(route('dashboard.staff-code').'?error=1&message=Kode%20tidak%20boleh%20sama%20dengan%20yang%20lama');
        }

        $update = [
            'staff_code' => $code
        ];

        StaffCode::where('staff_code', $current_code)->update($update);

        return redirect(route('dashboard.staff-code').'?error=0&message=Kode%20staff%20berhasil%20diganti');
    }

    public function buat_form(){
        $user = Auth::user();
        return view('admin.buat-form', [
            'user' => $user,
            'title' => 'Buat Form'
        ]);
    }
}

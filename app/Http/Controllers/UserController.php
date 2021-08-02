<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use App\Models\UserUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use PasswordValidationRules;

    public function index(){
        $user = Auth::user();
        return view('user.dashboard', [
            'user' => $user,
            'title' => 'Dashboard'
        ]);
    }

    public function change_password(Request $request, $id){
        $user = User::where('id', $id)->first();

        $request->validate([
            'current_password' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
        ]);

        $current_password = $request->input('current_password');
        $password = $request->input('password');

        if(!Hash::check($current_password, $user->password)){
            return redirect(route('dahboard.profile').'?error=1&message=Password%20lama%20tidak%20sesuai');
        }

        $update = [
            'password' => Hash::make($password)
        ];

        $user->update($update);

        Auth::login($user);
        return redirect(route('dashboard.profile').'?success=1&message=Password%20berhasil%20diganti');
    }    

    public function edit_profile(Request $request){
        $user = Auth::user();

        $validatedData = $request->validate([
            'surat' => 'mimes:pdf|max:4096',
           ]);

        $surat = $user->surat;   
        if($request->file('surat')){
            $surat = $request->file('surat')->store('assets/files', 'public');
        }
        $nip = $request->input('nip');
        $jabatan = $request->input('jabatan');
        $unit = $request->input('unit');

        $update = [
            'surat' => $surat,
            'nip' => $nip,
            'jabatan' => $jabatan,
            'unit' => $unit
        ];

        User::where('id', $user->id)->update($update);

        return redirect(route('dashboard.profile').'?success=1&message=Profile%20berhasil%20diganti');
    }

    public function edit(){
        $user = Auth::user();
        $units = UserUnit::get();
        return view('user-profile', [
            'user' => $user,
            'title' => 'Edit Profile',
            'units' => $units
        ]);
    }
}

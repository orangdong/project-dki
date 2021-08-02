<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use App\Models\UserUnit;
use App\Models\Form;
use App\Models\SpekForm;
use App\Models\SpekSubForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use PasswordValidationRules;

    public function index(){
        $user = Auth::user();
        $form = Form::all();
        return view('user.dashboard', [
            'user' => $user,
            'form' => $form,
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

    public function isi_form(Request $request){
        $user = Auth::user();
        $form_id = $request->input('id');
        $form = Form::whereid($form_id)->first();
        $spek_form = SpekForm::where('form_id',$form_id)->with('spek_sub_forms')->get();
        $user_unit = UserUnit::all();
        if(!$form_id){
            return redirect(route('dashboard.admin'));
        }
        return view('user.isi-form', [
            'user' => $user,
            'form_id' => $form_id,
            'form_title' => $form->title,
            'spek_form' => $spek_form,
            'user_unit' => $user_unit,
            'title' => 'Isi Form'
        ]);
    }
}

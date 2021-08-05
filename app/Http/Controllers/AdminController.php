<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\ExportForm;
use App\Models\StaffCode;
use App\Models\Form;
use App\Models\SpekForm;
use App\Models\SpekSubForm;
use App\Models\FormTujuan;
use App\Models\User;
use App\Models\UserUnit;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    use PasswordValidationRules;

    public function index(){
        $user = Auth::user();
        $form = Form::all();
        
        return view('admin.dashboard', [
            'user' => $user,
            'form' => $form,
            'title' => 'Dashboard'
        ]);
    }

    public function edit_user(Request $request){
        $data = $request->all();
        $user_id = $request->input('user_id');
        $user = User::where('id', $user_id)->first();

        $user->update($data);
        return redirect(route('dashboard.user-management'))->with('success','Edit user berhasil');
    }

    public function change_user_password(Request $request){
        $user = User::where('id', $request->input('user_id'));
        $request->validate([
            'password' => $this->passwordRules()
        ]);

        $update = [
            'password' => Hash::make($request->input('password'))
        ];

        $user->update($update);

        return redirect(route('dashboard.user-management'))->with('success','Ubah password berhasil');
    }

    public function export(){
        $user = Auth::user();
        $spek_form = SpekForm::with('form')->orderBy('form_id')->get();
        
        return view('admin.export', [
            'user' => $user,
            'spek_form' => $spek_form,
            'title' => 'Export Insert'
        ]);
    }

    public function user(){
        $user = Auth::user();
        $all = User::all();
        $units = UserUnit::all();

        return view('admin.user', [
            'user' => $user,
            'title' => 'User Management',
            'users' => $all,
            'units' => $units
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
            return redirect(route('dashboard.staff-code'))->with('danger','Kode konfirmasi tidak sesuai');
        }

        if($code == $current_code){
            return redirect(route('dashboard.staff-code'))->with('danger','Kode tidak boleh sama dengan yang lama');
        }

        $update = [
            'staff_code' => $code
        ];

        StaffCode::where('staff_code', $current_code)->update($update);

        return redirect(route('dashboard.staff-code'))->with('success','Ubah staff code berhasil');
    }

    public function buat_form(Request $request){
        $user = Auth::user();
        $form_id = $request->input('id');
        $form = Form::whereid($form_id)->first();
        $spek_form = SpekForm::where('form_id',$form_id)->with('spek_sub_forms')->get();
        $user_unit = UserUnit::all();
        $form_tujuan = FormTujuan::where('form_id',$form_id)->get();
        if(!$form_id){
            return redirect(route('dashboard.admin'))->with('warning','Forbidden');
        }
        return view('admin.buat-form', [
            'user' => $user,
            'form_id' => $form_id,
            'form_title' => $form->title,
            'valid_until' => $form->valid_until,
            'spek_form' => $spek_form,
            'user_unit' => $user_unit,
            'form_tujuan' => $form_tujuan,
            'title' => 'Buat Form'
        ]);
    }

    public function new_form(Request $request){
        $user = Auth::user();
        $title = $request->input('judul');
        $description = $request->input('deskripsi');
        $valid_until = $request->input('valid_until');
        
        Form::create([
            'title' => $title,
            'description' => $description,
            'valid_until' => $valid_until
        ]);
        $form = Form::where([['title',$title],['description',$description]])->first();

        return redirect(route('dashboard.buat-form').'?id='.$form->id)->with('success','Berhasil membuat form baru');
    }

    public function spek_form_tunggal(Request $request){
        $user = Auth::user();
        $data = $request->input('data');
        $pertanyaan = $request->input('pertanyaan');
        $form_id = $request->input('form_id');
        
        SpekForm::create([
            'form_id' => $form_id,
            'pertanyaan' => $pertanyaan,
            'type' => $data,
            'data' => $data
        ]);

        return redirect(route('dashboard.buat-form').'?id='.$form_id)->with('success','Berhasil menambah pertanyaan');
    }

    public function spek_form_ganda(Request $request){
        $user = Auth::user();
        $type = $request->input('radio');
        if($type !== "radio"){
            $type = "checkbox";
        }
        $data = $request->input('data');
        $pertanyaan = $request->input('pertanyaan');
        $opsi = $request->input('opsi');
        $form_id = $request->input('form_id');
        
        $spek_form = SpekForm::create([
            'form_id' => $form_id,
            'pertanyaan' => $pertanyaan,
            'type' => $type,
            'data' => $data
        ]);

        foreach($opsi as $o){
            $spek_sub_form = [
                'spek_form_id' => $spek_form->id,
                'option' => $o
            ];

            SpekSubForm::create($spek_sub_form);
        }

        return redirect(route('dashboard.buat-form').'?id='.$form_id)->with('success','Berhasil menambah pertanyaan');
    }

    public function edit_tujuan_form(Request $request){
        $user = Auth::user();
        $form_id = $request->input('form_id');
        FormTujuan::where('form_id',$form_id)->delete();
        $tujuan = $request->input('tujuan');

        if(empty($tujuan)){
            return redirect(route('dashboard.buat-form').'?id='.$form_id)->with('warning','Form nonaktif');
        }
        
        foreach($tujuan as $t){
            FormTujuan::create([
                'form_id' => $form_id,
                'unit_tujuan' => $t
            ]);
        }

        return redirect(route('dashboard.buat-form').'?id='.$form_id)->with('success','Tujuan unit telah diperbaharui');
    }

    public function hapus_spek_form(Request $request){
        $spek_form_id = $request->input('spek_form_id');
        $form_id = $request->input('form_id');
        SpekForm::whereid($spek_form_id)->delete();
        SpekSubForm::where('spek_form_id', $spek_form_id)->delete();

        return redirect(route('dashboard.buat-form').'?id='.$form_id)->with('warning','Pertanyaan telah dihapus');
    }

    public function edit_valid_until(Request $request){
        $form_id = $request->input('form_id');
        $valid_until = $request->input('valid_until');
        Form::whereid($form_id)->update(['valid_until' => $valid_until]);

        return redirect(route('dashboard.admin'))->with('success','Perubahan deadline berhasil');
    }

    public function submit_export(Request $request){
        $user = Auth::user();
        $spek_form_id = $request->input('spek_form_id');

        foreach($spek_form_id as $s){
            $ada_export = ExportForm::where([['spek_form_id',$s],['user_id',$user->id]])->count();
            if($ada_export < 1){
                ExportForm::create([
                    'user_id' => $user->id,
                    'spek_form_id' => $s
                ]);
            }
        }

        return redirect(route('view-export'))->with('success','Pemilihan sukses');
    }

    public function clear_export(){
        $user = Auth::user();
        ExportForm::where('user_id',$user->id)->delete();

        return redirect(route('view-export'))->with('success','Clear view berhasil');
    }

    public function view_export(){
        $user = Auth::user();
        $export_form = ExportForm::where('user_id',$user->id)->with('spek_form.spek_sub_forms','spek_form.form_values.user')->get();

        return view('admin.view-export',[
            'export_form' => $export_form,
            'title' => 'Export View'
        ]);
    }

    public function download_export(){
        $user = Auth::user();
        $export_form = ExportForm::where('user_id',$user->id)->with('spek_form.spek_sub_forms','spek_form.form_values.user')->get();
        return view('admin.download-export',['export_form'=>$export_form]);
        //$pdf = PDF::loadView('admin.download-export',['export_form'=>$export_form])->setOptions(['defaultFont' => url('storage/fonts/poppins_300_ea8381d11630c33f2ab271919542aa73.ufm')]);
        //return $pdf->download('export-form.pdf');
    }

}

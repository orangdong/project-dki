<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('login'));
});

// is login
Route::prefix('dashboard')
    ->middleware(['auth:sanctum'])
    ->group(function()
    {   
        Route::get('user-profile', [UserController::class, 'edit'])->name('dashboard.profile');
        Route::post('user-profile', [UserController::class, 'edit_profile'])->name('dashboard.profile.edit');
        

        Route::middleware(['isAdmin'])->group(function(){
            Route::get('form', [AdminController::class, 'index'])->name('dashboard.admin');
            Route::post('form', [AdminController::class, 'new_form'])->name('dashboard.new-form');
            Route::get('export', [AdminController::class, 'export'])->name('dashboard.export');
            Route::get('user', [AdminController::class, 'user'])->name('dashboard.user-management');
            Route::get('staff-code', [AdminController::class, 'staff_code'])->name('dashboard.staff-code');
            Route::get('buat-form', [AdminController::class, 'buat_form'])->name('dashboard.buat-form');
            Route::post('spek-form-tunggal', [AdminController::class, 'spek_form_tunggal'])->name('dashboard.spek-form-tunggal');
            Route::post('spek-form-ganda', [AdminController::class, 'spek_form_ganda'])->name('dashboard.spek-form-ganda');
            Route::post('edit-tujuan-form', [AdminController::class, 'edit_tujuan_form'])->name('dashboard.edit-tujuan-form');
            Route::get('hapus-spek-form', [AdminController::class, 'hapus_spek_form'])->name('dashboard.hapus-spek-form');
            Route::post('edit-valid-until', [AdminController::class, 'edit_valid_until'])->name('dashboard.edit-valid-until');
            Route::post('edit-code', [AdminController::class, 'edit_code'])->name('edit-code');
            Route::post('user', [AdminController::class, 'edit_user'])->name('edit-user');
            Route::post('change-user-password', [AdminController::class, 'change_user_password'])->name('change-user-password');
            Route::post('submit-export', [AdminController::class, 'submit_export'])->name('submit-export');
            Route::get('view-export', [AdminController::class, 'view_export'])->name('view-export');
        });

        Route::middleware(['isUser'])->group(function(){
            Route::get('/', [UserController::class, 'index'])->name('dashboard.user');
            Route::get('isi-form', [UserController::class, 'isi_form'])->name('dashboard.isi-form');
            Route::post('submit-form', [UserController::class, 'submit_form'])->name('dashboard.submit-form');
            Route::get('view-form', [UserController::class, 'view_form'])->name('dashboard.view-form');
            Route::get('edit-form', [UserController::class, 'edit_form'])->name('dashboard.edit-form');
        });
        
    });
    Route::post('change-password/{id}', [UserController::class, 'change_password'])->name('change-password');
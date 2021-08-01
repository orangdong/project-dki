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

        Route::middleware(['isAdmin'])->group(function(){
            Route::get('form', [AdminController::class, 'index'])->name('dashboard.admin');
            Route::get('export', [AdminController::class, 'export'])->name('dashboard.export');
            Route::get('user', [AdminController::class, 'user'])->name('dashboard.user-management');
            Route::get('staff-code', [AdminController::class, 'staff_code'])->name('dashboard.staff-code');
            Route::get('buat-form', [AdminController::class, 'buat_form'])->name('dashboard.buat-form');
        });

        Route::middleware(['isUser'])->group(function(){
            Route::get('/', [UserController::class, 'index'])->name('dashboard.user');
        });
        
    });

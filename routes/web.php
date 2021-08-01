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
        Route::middleware(['isAdmin'])->group(function(){
            Route::get('form', [AdminController::class, 'index'])->name('dashboard.admin');
        });

        Route::middleware(['isUser'])->group(function(){
            Route::get('/', [UserController::class, 'index'])->name('dashboard.user');
        });
        
    });

<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\AuthenController;
use App\Http\Controllers\MemberController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthenController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthenController::class, 'handleLogin']);

Route::get('register', [AuthenController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthenController::class, 'handleRegister']);

Route::post('logout', [AuthenController::class, 'logout'])->name('logout');

Route::get('member', [MemberController::class, 'dashboard'])
    ->name('member.dashboard')
    ->middleware(['auth', IsMember::class]);

Route::get('admin', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard')
    ->middleware(['auth', IsAdmin::class]);

// Route cho API
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// Route cho API Authen
Route::post('api/register', [AuthenController::class, 'handleRegisterApi']);
Route::post('api/login', [AuthenController::class, 'handleLoginApi']);
Route::middleware('auth:sanctum')->post('api/logout', [AuthenController::class, 'logoutApi']);


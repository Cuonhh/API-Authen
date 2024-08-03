<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\AuthenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [AuthenController::class, 'handleRegisterApi']);
Route::post('login', [AuthenController::class, 'handleLoginApi']);
Route::middleware('auth:sanctum')->post('logout', [AuthenController::class, 'logoutApi']);

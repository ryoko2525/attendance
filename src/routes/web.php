<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\WorkController;



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
// ユーザー登録画面
Route::get('/register', [UserController::class, 'create']);
// ログイン画面
Route::get('/login', [SessionController::class, 'create']);

// 打刻画面
Route::get('/stamp', [WorkController::class, 'index']);
// その日の打刻一覧
Route::get('/date', [WorkController::class, 'show']);
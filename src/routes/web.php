<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\BreakController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
// */
// ユーザー登録画面
Route::get('/', [UserController::class, 'index']);

// 打刻画面
Route::middleware('auth')->group(function () {
    Route::get('/stamp', [WorkController::class, 'index']);
});
//勤務開始
Route::post('/work/start', [WorkController::class, 'start'])->name('work.start')->middleware('auth');
//勤務終了
Route::post('/work/end', [WorkController::class, 'end'])->name('work.end')->middleware('auth');

//休憩開始
Route::post('/break/start', [BreakController::class, 'start'])->name('break.start')->middleware('auth');
//休憩終了
Route::post('/break/end', [BreakController::class, 'end'])->name('break.end')->middleware('auth');


// その日の打刻一覧
Route::get('/date', [WorkController::class, 'show']);

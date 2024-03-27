<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{UserController, WorkController, WorksController, BreakController};



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
Route::get('/', [UserController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/stamp', [WorkController::class, 'index']);
    Route::post('/work/start', [WorkController::class, 'start'])->name('work.start');
    Route::post('/work/end', [WorkController::class, 'end'])->name('work.end');
    Route::post('/break/start', [BreakController::class, 'start'])->name('break.start');
    Route::post('/break/end', [BreakController::class, 'end'])->name('break.end');
    Route::get('/date/{date?}', [WorksController::class, 'show'])->name('works.day');
});

<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Timetracking\checkin_out;
use App\Http\Controllers\Timetracking\amendments;

Route::get('/test', function () {
    return view('index');
});


// authentication
Route::get('/', [Login::class, 'index']);
Route::post('/', [Login::class, 'login'])->name('auth.login');
Route::get('/logout', [Login::class, 'logout'])->name('auth.logout');

Route::prefix('timetracking')->group(function() {
    Route::get('/checkin', [checkin_out::class, 'index'])->name('checkin');

    Route::get('/amendments', [amendments::class, 'index'])->name('amendments');
});


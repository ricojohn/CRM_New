<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Timetracking\checkin_out;
use App\Http\Controllers\Timetracking\amendments;
use App\Http\Controllers\Recording\recordings;
use App\Http\Controllers\Employee\employees;
use App\Http\Controllers\Employee\timesheet;

// Route::get('/test', function () {
//     return view('index');
// });


// authentication
Route::get('/', [Login::class, 'index']);
Route::post('/', [Login::class, 'login'])->name('auth.login');
Route::get('/logout', [Login::class, 'logout'])->name('auth.logout');

Route::middleware(['auth'])->group(function () {
    Route::prefix('timetracking')->group(function() {
        Route::get('/checkin', [checkin_out::class, 'index'])->name('timetracking.checkin');
    
        Route::get('/amendments', [amendments::class, 'index'])->name('timetracking.amendments');
    });
    
    Route::prefix('recording')->group(function() {
        Route::get('/record', [recordings::class, 'index'])->name('recording.record');
    
        Route::post('/upload', [recordings::class, 'upload'])->name('recording.upload');
    });
    
    Route::prefix('employee')->group(function() {
        Route::get('/employees', [employees::class, 'index'])->name('employee.employees');
    
        Route::get('/timesheet', [timesheet::class, 'index'])->name('employee.timesheet');
    });
});


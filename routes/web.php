<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Timetracking\checkin_out;
use App\Http\Controllers\Timetracking\amendments;
use App\Http\Controllers\Recording\recordings;
use App\Http\Controllers\Employee\employees;
use App\Http\Controllers\Employee\timesheet;
use App\Http\Controllers\Client\clientList;
use App\Http\Controllers\Client\quotation;
use App\Http\Controllers\Billing;
use App\Http\Controllers\Roles\roles;

// Route::get('/test', function () {
//     return view('index');
// });


// authentication
Route::get('/', [Login::class, 'index']);
Route::post('/', [Login::class, 'login'])->name('auth.login');
Route::get('/logout', [Login::class, 'logout'])->name('auth.logout');
Route::get('/keepalive', function () {
    return response()->json(['status' => 'session refreshed']);
})->name('keepalive');

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

    Route::prefix('roles')->middleware(['role:Admin'])->group(function() {
        Route::get('/roles', [roles::class, 'index'])->name('roles.roles');
    });

    Route::prefix('client')->middleware(['permission:client-project'])->group(function() {
        Route::get('/clientlist', [clientList::class, 'index'])->name('client.clientlist');
    
        Route::get('/quote', [quotation::class, 'index'])->name('client.quote');
    });

    Route::prefix('billing')->middleware(['permission:billing'])->group(function() {
        Route::get('/generateinvoice', [Billing::class, 'generateInvoice'])->name('billing.generateinvoice');
    
        Route::get('/summary', [Billing::class, 'summary'])->name('billing.summary');
        Route::get('/summary/view/{id}', [Billing::class, 'summaryView'])->name('billing.summary.view');
        Route::get('/summary/edit/{id}', [Billing::class, 'summaryEdit'])->name('billing.summary.edit');

        Route::get('/invoiceitems', [Billing::class, 'invoiceItems'])->name('billing.invoiceitem');
    });
});


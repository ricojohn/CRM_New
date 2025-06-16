<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
use App\Http\Controllers\Twilio\call;
use App\Http\Controllers\Twilio\sms;
use Twilio\Jwt\ClientToken;



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

    Route::prefix('twilio')->group(function() {
        Route::get('/test-call', [call::class, 'call']);

        Route::get('/call', [call::class, 'index'])->name('twilio.call');
    
        Route::get('/sms', [sms::class, 'index'])->name('twilio.sms');

        Route::post('/voice', function () {
            return response('<?xml version="1.0" encoding="UTF-8"?>
                <Response>
                    <Say voice="alice">Hello! This is a test call from your Laravel app.</Say>
                </Response>', 200)
                ->header('Content-Type', 'text/xml');
        })->name(name: 'twilio.voice');

        // Generate token for browser Twilio Client
        Route::get('/token', function () {
            $identity = Auth::id() ? 'user_' . Auth::id() : 'guest_' . uniqid();

            $capability = new ClientToken(
                config('services.twilio.sid'),
                config('services.twilio.token')
            );

            $capability->allowClientOutgoing(config('services.twilio.app_sid'));
            $capability->allowClientIncoming($identity);

            return response()->json([
                'identity' => $identity,
                'token' => $capability->generateToken(),
            ]);
        })->name('twilio.token');

        // This returns TwiML for outgoing calls
        Route::post('/voice-web', function (\Illuminate\Http\Request $request) {
            $to = $request->input('To');

            $twiml = new \Twilio\TwiML\VoiceResponse();

            if (preg_match('/^[\d\+\-\(\) ]+$/', $to)) {
                $twiml->dial($to); // PSTN
            } else {
                $twiml->dial()->client($to); // Twilio Client
            }

            return response($twiml, 200)->header('Content-Type', 'text/xml');
        })->name('twilio.voice-web');

    });


});


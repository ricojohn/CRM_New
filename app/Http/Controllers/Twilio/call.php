<?php

namespace App\Http\Controllers\Twilio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TwilioService;

class call extends Controller
{
    public function index(){
        // Check if the user is already authenticated
        if (Auth::check()) {
            // Redirect them to the home page if logged in
            return view('twilio.call');
        }

        // Show the login form if not logged in
        return redirect('auth.logout');

    }

    public function call()
    {
        try {
            $twilio = new TwilioService();
            $twilio->makeCall('+639957802471', route('twilio.voice')); // Replace with real number
            return 'Call started!';
        } catch (\Exception $e) {
            logger()->error('Twilio call error: ' . $e->getMessage());
            dd('Failed to make call: ' . $e->getMessage());
        }
    }
}

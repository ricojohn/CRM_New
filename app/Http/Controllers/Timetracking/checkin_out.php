<?php

namespace App\Http\Controllers\Timetracking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkin_out extends Controller
{
    public function index()
    {
        // Check if the user is already authenticated
    if (Auth::check()) {
        // Redirect them to the home page if logged in
        return view('timetracking.checkin');
    }
  
      // Show the login form if not logged in
      return view('auth.login');
    }//
}

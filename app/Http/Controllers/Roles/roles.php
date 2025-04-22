<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class roles extends Controller
{
    public function index(){
        // Check if the user is already authenticated
        if (Auth::check()) {
            // Redirect them to the home page if logged in
            return view('roles.index');
        }

        // Show the login form if not logged in
        return redirect('auth.logout');

    }
}

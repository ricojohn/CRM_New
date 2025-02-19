<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class clientList extends Controller
{
    public function index(){
        // Check if the user is already authenticated
        if (Auth::check()) {
            // Redirect them to the home page if logged in
            return view('clients.clientproject.index');
        }

        // Show the login form if not logged in
        return redirect('auth.logout');

    }
}

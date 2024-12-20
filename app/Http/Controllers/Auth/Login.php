<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\q8_employee;

class Login extends Controller
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
    }

    public function login(Request $request){
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Retrieve the user by email from the q8_employee table
        $user = q8_employee::where('email', $request->email)->first();
    
        // Check if the user exists and the password is correct
        if ($user && Hash::check($request->password, $user->password)) {
          $remember = $request->has('remember');
    
          // Log the user in with the "Remember Me" option
          Auth::login($user, $remember);
    
          // Store user info in the session
          session()->put('user', $user);
    
          return redirect()->route('checkin');
        }
    
        return back()->withErrors(['credentials' => 'Invalid login credentials']);
      }
    
      public function logout()
      {
          Auth::logout();
          session()->forget('user');
    
          return redirect('/')->with('success', 'Logged out successfully.');
      }
}

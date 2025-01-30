<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class timesheet extends Controller
{
    public function index(){
        if (Auth::check()) {
            // Redirect them to the home page if logged in
            return view('employee.timesheet.index');
        }

        return redirect('auth.logout');

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Billing extends Controller
{
    public function generateInvoice(){
        // Check if the user is already authenticated
        if (Auth::check()) {
            // Redirect them to the home page if logged in
            return view('billing.generateinvoice.index');
        }

        // Show the login form if not logged in
        return redirect('auth.logout');

    }

    public function summary(){
        // Check if the user is already authenticated
        if (Auth::check()) {
            // Redirect them to the home page if logged in
            return view('billing.summary.index');
        }

        // Show the login form if not logged in
        return redirect('auth.logout');
    }

    public function invoiceItems(){
        // Check if the user is already authenticated
        if (Auth::check()) {
            // Redirect them to the home page if logged in
            return view('billing.invoiceitems.index');
        }

        // Show the login form if not logged in
        return redirect('auth.logout');
    }
}

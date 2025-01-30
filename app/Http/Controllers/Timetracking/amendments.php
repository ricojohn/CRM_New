<?php

namespace App\Http\Controllers\Timetracking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class amendments extends Controller
{
    public function index(){
        return view('timetracking.amendments');
    }
}

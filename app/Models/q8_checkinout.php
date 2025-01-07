<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class q8_checkinout extends Model
{
    protected $table = 'q8_checkinout'; // Specify the table name


    protected $fillable = [
        'employee_id',
        'date',
        'check_in_time',
        'check_out_time',
        'dateout',
        // Add any other fields you need
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallLog extends Model
{
     protected $table = 'calls'; // Specify the table name


    protected $fillable = [
        'phone_number',
        'call_start',
        'call_end',
        'total_minutes',
        // Add any other fields you need
    ];
}

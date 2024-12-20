<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class q8_employee extends Authenticatable
{
    use Notifiable;

    protected $table = 'q8_employee'; // Specify the table name

    protected $fillable = [
        'name',
        'email',
        'password',
        // Add any other fields you need
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}

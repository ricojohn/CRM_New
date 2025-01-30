<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function checkInOuts(): HasMany
    {
        return $this->hasMany(q8_checkinout::class, 'employee_id', 'employee_id');
    }

    // public function checkIns($startDate = null, $endDate = null)
    // {
    //     return $this->hasMany(q8_checkinout::class, 'employee_id', 'id')
    //         ->when($startDate, function ($query) use ($startDate, $endDate) {
    //             $query->whereDate('date', '=', $startDate);
    //                 // ->whereDate('date', '<=', $endDate)
    //         });
    // }
}

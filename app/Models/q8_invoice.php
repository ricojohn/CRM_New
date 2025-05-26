<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class q8_invoice extends Model
{
    protected $table = 'q8_invoice'; // Specify the table name

    protected $fillable = [
        'invoice_id',
        'invoice_date',
        'invoice_no',
        'client',
        'project',
        'due_date',
        'notes',
        'subtotal',
        'email',
        'status',
        'sales_representative',
        'commission',
        // Add any other fields you need
    ];
}

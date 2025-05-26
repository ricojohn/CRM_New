<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class q8_invoice_details extends Model
{
    protected $table = 'q8_invoice_details'; // Specify the table name

    protected $fillable = [
        'invoice_id',
        'invoice_no',
        'item_date',
        'item_desc',
        'item_qty',
        'item_unitprice',
        'item_total',
    ];
}

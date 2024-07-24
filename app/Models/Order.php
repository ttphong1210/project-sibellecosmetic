<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 'orders';
    protected $primaKey = 'id';
    protected $fillable = [
        'customer_id',
        'date_order',
        'total',
        'notes',
        'order_status',
        'order_code',
        'order_payment',
    ];
}

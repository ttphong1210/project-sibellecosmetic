<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    protected $table = 'order_details';
    protected $primaKey = 'id';
    protected $fillable = [
        'order_id',
        'product_id',
        'quantily',
        'price',
        'order_code',
        'order_payment',
    ];
}

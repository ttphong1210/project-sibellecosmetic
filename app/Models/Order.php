<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = [
        'customer_id',
        'date_order',
        'total',
        'notes',
        'order_status',
        'order_code',
        'order_payment',
    ];
    protected $casts = [
        'date_order' => 'datetime',
    ];

    public function customer(){
       return $this->belongsTo(Customer::class,'customer_id', 'cust_id');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}

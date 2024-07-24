<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = 'customers';
    protected $primaryKey = 'cust_id';
    protected $fillable = [
        'cust_name',
        'cust_phone',
        'cust_email',
        'address',
        'notes',
    ];


}

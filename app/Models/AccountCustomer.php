<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AccountCustomer extends Model implements Authenticatable
{
    //
    use Notifiable, AuthenticatableTrait;
    protected $table = 'account_customer';
    protected $fillable = [
       'name', 'number_phone', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}

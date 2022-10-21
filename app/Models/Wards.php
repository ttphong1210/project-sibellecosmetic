<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    //
    protected $table = 'xaphuongthitran';
    protected $primakey = 'xaid';
    protected $fillable = [
        'name_ward','type','maqh'
    ];
}

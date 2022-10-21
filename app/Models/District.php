<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //
    protected $table = 'quanhuyen';
    protected $primaKey = 'maqh';
    protected $fillable = [
        'name_district','type','matp'
    ];
}

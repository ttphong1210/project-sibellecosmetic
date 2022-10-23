<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeShip extends Model
{
    //
    protected $table = 'feeship';
    protected $primaKey = 'fee_id';
    protected $fillable = [
        'fee_matp','fee_maqh','fee_xaid'
    ];
    
    public function city(){
        return $this->belongsTo('App\Models\City','fee_matp');
    }
    public function district(){
        return $this->belongsTo('App\Models\District','fee_maqh');
    }
    public function ward(){
        return $this->belongsTo('App\Models\Ward','fee_xaid');
    }
}

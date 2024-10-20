<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Brand extends Model
{
    //
    
    protected $table = 'brands';
    protected $primaryKey = 'brand_id';
    protected $fillable=[
        'brand_name',
        'brand_slug'
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }

}
